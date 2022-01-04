<?php


namespace Warehouse\Controller;

use Warehouse\Model\Positions;
use Warehouse\Request\Request;
use Warehouse\View\View;

class PositionController extends Controller
{

    public function all()
    {
        $positions = Positions::all();
        View::render('positions.index', ['positions' => $positions]);
    }
    public function byId(){
        $request = new Request();
        $data = $request->getBody();
        $id = $data['id'];
        $positions = Positions::findById($id);
        View::render('positions.show', ['positions' => $positions]);
    }
    public function createForm(){
        View::render('positions.createForm');
    }
    public function create()
    {
        $request = new Request();
        $data = $request->getBody();
        $positions = Positions::create($data);
        if ($positions) {
            header("Location: /positions");
        } else{
            dump(0);
        }
        Positions::create($data);
        $this->redirect('/positions');
    }
    public function delete(){
        $request = new Request();
        $data = $request->getBody();
        $positions = Positions::delete($data);
        if ($positions) {
            header("Location: /positions");
        } else{
            dump(0);
        }
        Positions::delete($data);
        $this->redirect('/positions');
    }
    public function updateForm(){

        $request = new Request();
        $data = $request->getBody();
        $id = $data['id'];
        $positions = Positions::findById($id);
        View::render('positions.updateForm', ['positions' => $positions]);
    }

    public function update()
    {
        $request = new Request();
        $data = $request->getBody();
        $id = $data['id'];
        $positions = Positions::update($data,$id);
        if ($positions) {
            header("Location: /positions");
        } else{
            dump(0);
        }
        Positions::update($data,$id);
        $this->redirect('/positions');
    }



}

