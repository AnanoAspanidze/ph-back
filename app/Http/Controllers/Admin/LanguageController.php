<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Http\Traits\SafeResponse;
use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
    use SafeResponse;

    private $language;
    private $languagesConf = [
        "ka" => "ქართული",
        "en" => "ინგლისური",
        "ru" => "რუსული",
        "gr" => "გერმანული",
        "es" => "ესპანური"
    ];

    public function __construct( Language $language ) {
        $this->language = $language;
    }

    public function index(Request $request) {
        $languages = $this->language->get();
        return view('web.backend.sections.languages.index', compact('languages'));
    }

    public function create(Request $request) {
        return view('web.backend.sections.languages.add', ['languagesConf' => $this->languagesConf]);
    }

    public function store(LanguageRequest $request) {
        try{

            $data = $request->except("_token");
            $data['active'] = isset($data['active']) ? true : false;
            $data['name'] = $this->languagesConf[$request->locale];

            $this->language->create($data);

            $languages = config('languages');
            $languages[$data['locale']] =  $data['name'];

            $this->updateFile($languages);

            return back()->with('success','ენა წარმატებით დაემატა');
        } catch (\Throwable $e) {
            return back()->with('error','ენის დამატება ვერ მოხერხდა');   
        }
    }
      
    public function activate(Request $request, $id) {
        $messages = [
            'success' => $request->status ? "ენა წარმატებით გაქტიურდა" : "ენა წარმატებით დიაქტივირებულია",
            'error' => "ენის გააქტიურება ვერ მოხერხდა"
        ];
        return $this->safeResponse(function() use ($request, $id) {

            $lang = $this->language->findOrFail($id);
            $lang->update(['active' => $request->status]);
            
            $languages = config('languages');

            if($request->status) {
                $languages[$lang->locale] = $lang->name;
            }else {
                unset($languages[$lang->locale]);
            }
            
            $this->updateFile($languages);

            return [ "type" => 200, "errors" => []];
        }, $messages);
    }

    private function updateFile($languages) {
        $file_path =base_path().'/config/languages.php';
        
        if ( !file_exists($file_path) )
            throw new Exception("Something wents wrong");
                
        if(!file_put_contents($file_path, $this->arrayToPhpArray($languages))) {
            throw new Exception("Something wents wrong");
        }
    }

    private function arrayToPhpArray($arr) {
        return "<?php \n\nreturn " . $this->arrayToString($arr) . ";";
    }

    private function arrayToString($arr, $tabs = 0, $startTabs = true) {
        return rtrim($this->arrayToStringWrapper($arr, $tabs, $startTabs), ",\n ");
    }
  
    private function arrayToStringWrapper($arr, $tabs = 0, $startTabs = true) {
        $result = ($startTabs ? str_repeat("\t", $tabs) : "") . '[' . "\n";
        
        if ($startTabs) {
          $tabs++;
        }
  
        foreach ($arr as $key => $value) {
    
            $result .= str_repeat("\t", $tabs)  . json_encode($key, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . ' => ';
    
            if (is_array($value)) {
                $result .= $this->arrayToStringWrapper($value, $tabs + 1, false);
            } else {
                $result .=  json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)  . ",\n";
            }
        }
        
        $tabs--;
        $result .= str_repeat("\t", $tabs) . '],' . "\n";
        return $result;
    }

}