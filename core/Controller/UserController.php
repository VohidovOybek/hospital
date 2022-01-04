<?php


namespace Warehouse\Controller;



use Warehouse\Model\User;
use Warehouse\Request\Request;
use Warehouse\View\View;

class UserController extends Controller
{
    public function all()
    {
        $users = User::all();
        View::render('users.index', ['users' => $users]);
    }

    public function byId()
    {
        echo "This is by id method";
    }

    public function getByName()
    {
        $new_user_model = new User();
        $result = $new_user_model->select("users", ['name', 'username'])
            ->where('name', 'ali', '=')
            ->where('id', '1', '=')->get();
    }

    public function showCreateForm()
    {
        View::render('users.create');
    }

    public function saveUser()
    {
        $request = new Request();
        $data = $request->getBody();
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        if ($request->hasFile('image')) {
            $url = $request->saveFile('image', 'images');
            if ($url) {
                $data['img_path'] = $url;
            }
        }
        User::create($data);
        $this->redirect('/users');
    }

    public function delete()
    {
        $request = new Request();
        $id = $request->getBody()['id'] ?? null;
        if ($id) {
            $user = User::findById($id);
            $img_path = $user['img_path'];
            unlink($_SERVER["DOCUMENT_ROOT"] . "/" . asset($img_path));
            User::delete($id);
            $this->redirect('/users');
        }
        View::render('404');
    }


    public function json_data()
    {
        header("Content-Type: application/json");
        $users = User::all();
        $json_users = json_encode($users);
        echo $json_users;
    }

    public function showAjaxPage()
    {
        View::render('users.ajax_page');
    }

    public function ajaxDelete()
    {
        $req = new Request();
        $user_id = $req->getJsonBody()['user_id'];
        $user = User::findById($user_id);
        $img_path = $user['img_path'];
        $filename = $_SERVER["DOCUMENT_ROOT"] . "/" . asset($img_path);
        if (!is_dir($filename) && file_exists($filename)) {
            unlink($filename);
        }
        User::delete($user_id);
        header("Content-Type: application/json");
        $response = [
            'status' => true,
            'message' => 'Пользователь успешно удален'
        ];
        echo json_encode($response);
    }

    public function ajaxCreate()
    {

        $req = new Request();
        $data = $req->getBody();
        if ($req->hasFile('image')) {
            $url = $req->saveFile('image', 'images');
            if ($url) {
                $data['img_path'] = $url;
            }
        }
        $name = $data['name'] ?? '';
        $username = $data['username'] ?? "";
        $password = $data['password'] ?? "";
        $password = password_hash($password, PASSWORD_DEFAULT);
        User::create([
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'img_path' => $data['img_path'] ?? null
        ]);
        header("Content-Type: application/json");
        $response = [
            'status' => true,
            'message' => 'Пользователь успешно создан'
        ];
        echo json_encode($response);
    }

    public function showUserAjax()
    {
        $req = new Request();
        $user_id = $req->getBody()['user_id'];
        $user = User::findById($user_id);
        header("Content-Type: application/json");
        if (count($user) > 0) {
            $data = [
                'status' => true,
                "user" => $user
            ];
            echo json_encode($data);
        }
    }
}

