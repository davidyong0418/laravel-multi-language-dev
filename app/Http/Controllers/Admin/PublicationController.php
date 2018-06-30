<?php

namespace App\Http\Controllers;
use App\Publications;
use Illuminate\Http\Request;
class PublicationController extends Controller {


    public function __construct()
    {
        $this->middleware('permission:view pages')->only('index');
        $this->middleware('permission:create page')->only('create', 'store');
        $this->middleware('permission:edit page')->only('edit', 'update');
        $this->middleware('permission:delete page')->only('destroy');
    }


    public function index(Request $request)
    {
        return view('publications.Admin.index', [
            'publications' => Publications::Where(
                'title',
                'like',
                '%' . $request->search . '%'
            )->orderBy('date','desc')->paginate(15),
            'search' => $request->search
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'title*' => 'max:255',
            'author' => 'required',
            'href' => 'required',
            'date' => 'required'

        ], [
            'title*.required'  => 'Название обязательное поле',
            'title*.max'       => 'Максимальная длина названия :max символов',
            'author.required'    => 'Автор обязательное поле для заполнения',
            'href.required'      => 'Ссылка обязательное поле для заполнения',
            'date.required' => 'Дата обязательное поле для заполнения'
        ]);

     $publication = new Publications();
     $publication->categories_id = $request['category'];
     $publication->title = $request['title'];
     $publication->author = $request['author'];
     $publication->href = $request['href'];
     $publication->date = $request['date'];
     $publication->save();

     $request->session()->flash(
         'success',
         sprintf('Публикация успешно добавлена')
        );
        return redirect()->route('admin.publications.index');
    }

    public function create() {
        return view('publications.create');
    }

    public function edit($id) {
        $sPublication = Publications::findOrFail($id);
        return view('publications.edit')->with('publications', $sPublication);
   }

    public function update(Request $request, $id){

        $publication = Publications::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'href' => 'required',
            'date' => 'required'
        ], [
            'title*.required'  => 'Название обязательное поле',
            'title*.max'       => 'Максимальная длина названия :max символов',
            'author.required'    => 'Автор обязательное поле для заполнения',
            'href.required'      => 'Ссылка обязательное поле для заполнения',
            'date.required' => 'Дата обязательное поле для заполнения'
        ]);

        $publication->categories_id = $request['category'];
        $publication->title = $request['title'];
        $publication->author = $request['author'];
        $publication->href = $request['href'];
        $publication->date = $request['date'];
        $publication->save();

        $request->session()->flash(
           'success',
           sprintf('Публикация успешно изменена')
        );

       return redirect()->route('admin.publications.index');
    }

    public function destroy(Request $request,$publication) {
        $sPublication = Publications::findOrFail($publication);
        $sPublication->delete();

        $request->session()->flash(
            'success',
            sprintf('Публикация успешно удалена')
        );
    }
}