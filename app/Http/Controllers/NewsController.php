    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Routing\RequeController;

    class NewsController extends Controller
    {

    public function index()
    {
    return "this is index method from route resource";
    }


    public function create()
    {
    return "this is create method";
    }


    public function store(Request $request)
    {
    return "store function";
    }


    public function show($id)
    {
    return $id ." "."show function";
    }

    public function edit($id)
    {
    return "this is edit function";
    }

    public function update(Request $request, $id)
    {
    //
    }


    public function destroy($id)
    {
    //
    }

    public function test()
    {

    }
