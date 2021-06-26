<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AboutRequest;
use App\Http\Requests\AboutImgRequest;
use App\Http\Traits\SafeResponse;
use App\Http\Traits\Helper;
use App\Models\Language;
use App\Models\About;
use App\Models\AboutImg;

class AboutController extends Controller
{
    use SafeResponse, Helper;

    private $about;
    private $language;
    private $aboutImg;    

    public function __construct( About $about, AboutImg $aboutImg, Language $language ) {
        $this->about = $about;
        $this->aboutImg = $aboutImg;
        $this->language = $language;
        app()->setLocale('ka');
    }

    public function index(Request $request) {
        $abouts = $this->about->select('id', 'pinned', 'active')->get();
        return view('web.backend.sections.about.index', compact('abouts'));
    }    

    public function create(Request $request) {
        $languages = $this->language->get();
        return view('web.backend.sections.about.add', compact('languages'));
    }

    public function store(AboutRequest $request) {
        try{
            
            $data = $request->except('_token');
            if( isset($data['illustration']) && file_exists($data['illustration'])){
                $data['illustration'] = \FileUpload::run($request->illustration, 'about');
            }

            $data['pinned'] =  (isset($data['pinned']) && $data['pinned'] == 'on') ? true : false;
            $data['topic_btn'] =  (isset($data['topic_btn']) && $data['topic_btn'] == 'on') ? true : false;
            $data['register_btn'] =  (isset($data['register_btn']) && $data['register_btn'] == 'on') ? true : false;

            $this->about->create($data);

            return back()->with('success','ჩვენზე წარმატებით დაემატა');
        } catch (\Throwable $e) {
            return back()->with('error','ჩვენზე დამატება ვერ მოხერხდა');
        }
    }

    public function edit(Request $request, $id) {
        $languages = $this->language->get();
        $about = $this->about->with('aboutImgs')->findOrFail($id);
        return view('web.backend.sections.about.edit', compact('about', 'languages'));
    }

    public function update(AboutRequest $request, $id) {
        try{

            $data = $request->except('_token');
            $about = $this->about->findOrFail($id);

            if( isset($data['illustration']) && file_exists($data['illustration'])){
                if($about->illustration) 
                    $this->deleteFile('storage/about/', $about->illustration);
                $data['illustration'] = \FileUpload::run($request->illustration, 'about');
            }

            $data['pinned'] =  (isset($data['pinned']) && $data['pinned'] == 'on') ? true : false;
            $data['topic_btn'] =  (isset($data['topic_btn']) && $data['topic_btn'] == 'on') ? true : false;
            $data['register_btn'] =  (isset($data['register_btn']) && $data['register_btn'] == 'on') ? true : false;

            $about->update($data);

            return back()->with('success','ჩვენზე წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','ჩვენზე განახლება ვერ მოხერხდა');   
        }
    }


    public function activate(Request $request, $id) {
        $messages = [
            'success' => $request->status ? "ჩვენზე წარმატებით გაქტიურდა" : "ჩვენზე წარმატებით დიაქტივირებულია",
            'error' => "ჩვენზე გააქტიურება ვერ მოხერხდა"
        ];

        return $this->safeResponse(function() use ($request, $id) {
            $this->about->findOrFail($id)->update(['active' => $request->status]);
            return [ "type" => 200, "errors" => []];
        }, $messages);
    }

    public function removeIllustration(Request $request, $id)
    {
        $messages = [
            'success' => "ფაილი წარმატებით წაიშალა",
            'error' => "ფაილის წაშლა ვერ მოხერხდა"
        ];
        return $this->safeResponse(function () use ($request, $id) {

            $about = $this->about->select("id", "illustration")->findOrFail($id);

            if (isset($request->filename)) {
                $this->deleteFile('storage/about/', $request->filename);
                $about->update(['illustration' => null]);
            }

            return ["type" => 200, "errors" => []];
        }, $messages);
    }
     
    // Illustrations
    public function illustrationCreate(Request $request, $about_id) {
        $languages = $this->language->get();
        return view('web.backend.sections.about.illustrations.add', compact('about_id', 'languages'));
    }

    public function illustrationStore(AboutImgRequest $request, $about_id) {
        try{

            $data = $request->except('_token');

            if( isset($data['illustration']) && file_exists($data['illustration'])){
                $data['illustration'] = \FileUpload::run($request->illustration, 'aboutIllustration');
            }
            
            $data['about_id'] = $about_id;
            
            $aboutImg = $this->aboutImg->create($data);
            
            return back()->with('success','ილუსტრაცია წარმატებით მიება ჩვენზე გვერდს');
        } catch (\Throwable $e) {
            return back()->with('error','ილუსტრაციის დამატება ვერ მოხერხდა');
        }
    }

    public function illustrationEdit(Request $request, $id) {
        $languages = $this->language->get();
        $aboutImg = $this->aboutImg->findOrFail($id);
        return view('web.backend.sections.about.illustrations.edit', compact('aboutImg', 'languages'));
    }

    public function illustrationUpdate(AboutImgRequest $request, $id) {
        try{
            $data = $request->except('_token');
            $aboutImg = $this->aboutImg->findOrFail($id);

            if( isset($data['illustration']) && file_exists($data['illustration'])){
                $this->deleteFile('storage/aboutIllustration/', $aboutImg->illustration);
                $data['illustration'] = \FileUpload::run($request->illustration, 'aboutIllustration');
            }
            
            $aboutImg->update($data);

            return back()->with('success','ილუსტრაცია წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','ილუსტრაციის განახლება ვერ მოხერხდა');
        }
    }

    public function illustrationActivate(Request $request, $id) {
        $messages = [
            'success' => $request->status ? "ილუსტრაცია წარმატებით გაქტიურდა" : "ილუსტრაცია წარმატებით დიაქტივირებულია",
            'error' => "ილუსტრაციის გააქტიურება ვერ მოხერხდა"
        ];
        return $this->safeResponse(function() use ($request, $id) {
            $this->aboutImg->findOrFail($id)->update(['active' => $request->status]);
            return [ "type" => 200, "errors" => []];
        }, $messages);
    }
}
