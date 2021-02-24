<?php

class TaskController extends Controller
{

    private $pageTpl = "/views/Task.tpl.php";
    private $productsPerPage = 5;

    public function __construct()
    {
        $this->model = new TaskModel();
        $this->view = new View();
        $this->utils = new Utils();
    }

    public function index()
    {

        if (isset($_GET['taskId'])) {
            $taskId = intval($_GET['taskId']);
            if ($taskId > 0) {
                $this->pageData['taskInfo'] = $this->model->getTaskById($taskId);
            }
        }

        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function getTask()
    {

        if (!isset($_GET['id'])) {
            echo json_encode(array("success" => false));
        } else {
            $taskId = $_GET['id'];
            $taskInfo = json_encode($this->model->getTaskById($taskId));
            echo $taskInfo;
        }

    }

    public function saveTask()
    {
        if (!isset($_SESSION['user'])) {
            echo json_encode(array("success" => false, "text" => "Для изменения задачи требуется авторизация администратором!"));
            return;
        }

        if (!isset($_POST['id']) || trim($_POST['content']) == '') {
            echo json_encode(array("success" => false, "text" => "Ошибка обновления данных"));
        } else {
            $taskId = $_POST['id'];
            $taskContent = strip_tags(trim($_POST['content']));
            $taskDone = strip_tags(trim($_POST['is_done']));
        }

        if ($this->model->saveTaskInfo($taskId, $taskContent, $taskDone)) {
            echo json_encode(array("success" => true, "text" => "Информация о задаче обновлена"));
        } else {
            echo json_encode(array("success" => false, "text" => "Ошибка обновления данных"));
        }
    }

    public function addTask()
    {

        if (empty($_POST) || trim($_POST['content']) == '' || trim($_POST['user']) == '' || trim($_POST['email']) == '') {
            echo json_encode(array("success" => false, "text" => "Не удалось добавить задачу"));
        } else {
            $content = strip_tags(trim($_POST['content']));
            $email = strip_tags(trim($_POST['email']));
            $user = strip_tags(trim($_POST['user']));
        }

        if ($this->model->addTask($user, $email, $content)) {
            echo json_encode(array("success" => true, "text" => "Новая задача добавлена"));
        } else {
            echo json_encode(array("success" => false, "text" => "Не удалось добавить задачу"));
        }
    }

}

?>
