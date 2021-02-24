<?php

class IndexController extends Controller
{

    private $pageTpl = "/views/main.tpl.php";
    private $tasksPerPage = 3;
    private $sortColumn = "id";
    private $sortDirect = "asc";

    public function __construct()
    {
        $this->model = new IndexModel();
        $this->view = new View();
        $this->utils = new Utils();
    }

    public function index()
    {
        $this->pageData['title'] = "Главная";

        // Разберемся с сортировками
        $reverseDirect = '';
        if (isset($_GET['sort']))
            $this->sortColumn = strtolower(strip_tags(trim($_GET['sort'])));
        // Если задан порядок сортировки получим его и зададим обратную сортировку
        if (isset($_GET['direct'])) {
            if ($_GET['direct'] == 'asc') {
                $this->sortDirect = 'asc';
                $reverseDirect = 'desc';
            } else {
                $this->sortDirect = 'desc';
                $reverseDirect = 'asc';
            }
        }

        // Получим текущую страницу, чтобы выводить в ссылках
        $page = isset($_GET['page']) ? '/?page=' . strip_tags($_GET['page']) : '/?page=1';

        $sortColumn = "&sort=" . $this->sortColumn;
        $direct = "&direct=" . $this->sortDirect;
        $this->pageData['sortHref'] = $page . $direct;
        $this->pageData['directHref'] = $page . $sortColumn;
        $this->pageData['reverseDirect'] = $reverseDirect;

        // Делаем пагинацию
        $allTasks = $this->model->getTaskCount();
        $totalPages = ceil($allTasks / $this->tasksPerPage);
        $this->makeTaskPager($allTasks, $totalPages);

        $pagination = $this->utils->drawPager($allTasks, $this->tasksPerPage, $sortColumn . $direct);

        $this->pageData['pagination'] = $pagination;

        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function makeTaskPager($allProducts, $totalPages)
    {
        if (isset($_GET['page']))
            $_GET['page'] = strip_tags(trim($_GET['page']));
        if (!isset($_GET['page']) || intval($_GET['page']) == 0 || intval($_GET['page']) == 1 || intval($_GET['page']) < 0) {
            $pageNumber = 1;
            $leftLimit = 0;
            $rightLimit = $this->tasksPerPage;
        } else if (intval($_GET['page']) > $totalPages || intval($_GET['page']) == $totalPages) {
            $pageNumber = $totalPages;
            $leftLimit = $this->tasksPerPage * ($pageNumber - 1);
            $rightLimit = $allProducts;
        } else {
            $pageNumber = intval($_GET['page']);
            $leftLimit = $this->tasksPerPage * ($pageNumber - 1);
            $rightLimit = $this->tasksPerPage;
        }

        $this->pageData['tasksOnPage'] = $this->model->getLimitTasks($leftLimit, $rightLimit, $this->sortColumn, $this->sortDirect);
    }

}
