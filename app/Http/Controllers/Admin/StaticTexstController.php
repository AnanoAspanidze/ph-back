<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Lang;
use App;

class StaticTexstController extends Controller
{
    private $language;
    private $file;
    private $path;
    private $arrayLang = array();
    private $defaultLangs;

    public function __construct( Language $language ) {
        $this->language = $language;
        $this->file = 'site';
        $this->defaultLangs = Lang::get('site');
        $this->erase_val($this->defaultLangs);
    }

    private function erase_val(&$myarr) {
        $myarr = array_map(function($n) { return null; }, $myarr);
    }

    public function index(Request $request) {
        $languages = $this->language->get();
        foreach($languages as $language) {
            $this->path = base_path().'/resources/lang/'.$language->locale.'/'.$this->file.'.php';
            app()->setLocale($language->locale);
            if(file_exists($this->path)) {
                $this->arrayLang[$language->locale] = Lang::get($this->file);
            }else {
                $this->arrayLang[$language->locale] = $this->defaultLangs;
            }
        }

        if (gettype($this->arrayLang) == 'string') $this->arrayLang = array();
        
   		return view('web.backend.sections.staticTexstes.index', ['languages' => $languages, 'locales' => $this->arrayLang]);
    }

    public function update(Request $request) {
      try{
        $languages = $this->language->get();  
        foreach ($languages as $language) {
            if ($request->has($language->locale) && is_array($request[$language->locale])) {
              $filename = base_path('resources/lang/' . $language->locale .'/'.$this->file.'.php');
              if(is_file($filename)) {
                  if(!file_put_contents($filename, $this->arrayToPhpArray($request[$language->locale]))) {
                    throw new Exception("Something wents wrong");
                  }
              }else {
                $structure = base_path('resources').'/lang/'. $language->locale .'/';
                if (!mkdir($structure, 0, true)) {
                  die('Failed to create folders...');
                }
                $file_handle = fopen($filename, 'w');
                
                if(!file_put_contents($filename, $this->arrayToPhpArray($request[$language->locale]))) {
                  throw new Exception("Something wents wrong");
                }
              }
            }
        }
        return back()->with('success','ტექსტები წარმატებით განახლდა');
      } catch (\Throwable $e) {
          return back()->with('error','ტექსტების განახლება ვერ მოხერხდა');
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
