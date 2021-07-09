<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
        Route::get('/', 'HomeController@index')->name('admin');
        
        // Profile
        Route::group(['prefix' => 'profile'], function() {
            Route::get('/edit/{id}', 'ProfileController@edit')->name('profile.edit');
            Route::post('/update/{id}', 'ProfileController@update')->name('profile.update');
        });

        // Language
        Route::group(['prefix' => 'language'], function() {
            Route::get('/', 'LanguageController@index')->name('language.index');
            Route::get('/create', 'LanguageController@create')->name('language.create');
            Route::post('/store', 'LanguageController@store')->name('language.store');
            Route::post('/activate/{id}', 'LanguageController@activate')->name('language.activate');
        });

        // Topics
        Route::group(['prefix' => 'topic'], function() {
            Route::get('/', 'TopicController@index')->name('topic.index');
            Route::get('/create', 'TopicController@create')->name('topic.create');
            Route::post('/store', 'TopicController@store')->name('topic.store');
            Route::get('/edit/{id}', 'TopicController@edit')->name('topic.edit');
            Route::post('/update/{id}', 'TopicController@update')->name('topic.update');
            Route::post('/activate/{id}', 'TopicController@activate')->name('topic.activate');
        });

        // Additional Resources
        Route::group(['prefix' => 'additional_resources'], function() {
            Route::get('/', 'AdditionalResourcesController@index')->name('additional_resources.index');
            Route::get('/create', 'AdditionalResourcesController@create')->name('additional_resources.create');
            Route::post('/store', 'AdditionalResourcesController@store')->name('additional_resources.store');
            Route::get('/edit/{id}', 'AdditionalResourcesController@edit')->name('additional_resources.edit');
            Route::post('/update/{id}', 'AdditionalResourcesController@update')->name('additional_resources.update');
            Route::post('/activate/{id}', 'AdditionalResourcesController@activate')->name('additional_resources.activate');
            Route::post('/destroy/{id}', 'AdditionalResourcesController@destroy')->name('additional_resources.destroy');
            Route::post('/getpage', 'AdditionalResourcesController@getPages')->name('additional_resources.getpages');
        });

        // Static Texstes
        Route::group(['prefix' => 'static_textes'], function() {
            Route::get('/', 'StaticTexstController@index')->name('static_textes.index');
            Route::post('/update', 'StaticTexstController@update')->name('static_textes.update');
        });

        // Teachers
        Route::group(['prefix' => 'teachers'], function() {
            Route::get('/', 'TeacherController@index')->name('teachers.index');
        });

        // About
        Route::group(['prefix' => 'about'], function() {
            Route::get('/', 'AboutController@index')->name('about.index');
            Route::get('/create', 'AboutController@create')->name('about.create');
            Route::post('/store', 'AboutController@store')->name('about.store');
            Route::get('/edit/{id}', 'AboutController@edit')->name('about.edit');
            Route::post('/update/{id}', 'AboutController@update')->name('about.update');
            Route::post('/activate/{id}', 'AboutController@activate')->name('about.activate');
            Route::post('/remove-file/{file}', 'AboutController@removeIllustration')->name('about.remove.illustration');

            Route::group(['prefix' => 'illustration'], function() {
                Route::get('/create/{about_id}', 'AboutController@illustrationCreate')->name('illustration.create');
                Route::post('/store/{about_id}', 'AboutController@illustrationStore')->name('illustration.store');
                Route::get('/edit/{id}', 'AboutController@illustrationEdit')->name('illustration.edit');
                Route::post('/update/{id}', 'AboutController@illustrationUpdate')->name('illustration.update');
                Route::post('/activate/{id}', 'AboutController@illustrationActivate')->name('illustration.activate');
            });
        });


        // Student Resources
        Route::group(['prefix' => 'student_resources'], function() {
            Route::get('/', 'StudentResourcesController@index')->name('student_resources.index');
            Route::get('/edit/{id}', 'StudentResourcesController@resources')->name('student_resources.resources');
            Route::post('/sort', 'StudentResourcesController@sortResources')->name('student_resources.sort');
            Route::post('/activate/{id}', 'StudentResourcesController@activate')->name('student_resources.activate');

            Route::group(['prefix' => 'first_page'], function() {
                Route::get('/create/{topic_id}', 'FirstPageController@create')->name('first_page.create');
                Route::post('/store/{topic_id}', 'FirstPageController@store')->name('first_page.store');
                Route::get('/edit/{id}', 'FirstPageController@edit')->name('first_page.edit');
                Route::post('/update/{id}', 'FirstPageController@update')->name('first_page.update');
            });

            Route::group(['prefix' => 'other_page'], function() {
                Route::get('/create/{topic_id}', 'OtherPageController@create')->name('other_page.create');
                Route::post('/store/{topic_id}', 'OtherPageController@store')->name('other_page.store');
                Route::get('/edit/{id}', 'OtherPageController@edit')->name('other_page.edit');
                Route::post('/update/{id}', 'OtherPageController@update')->name('other_page.update');
            });

            Route::group(['prefix' => 'step_page'], function() {
                Route::get('/create/{topic_id}', 'StepPageController@create')->name('step_page.create');
                Route::post('/store/{topic_id}', 'StepPageController@store')->name('step_page.store');
                Route::get('/edit/{id}', 'StepPageController@edit')->name('step_page.edit');
                Route::post('/update/{id}', 'StepPageController@update')->name('step_page.update');
            });

            Route::group(['prefix' => 'game_page'], function() {
                Route::get('/create/{topic_id}', 'GamePageController@create')->name('game_page.create');
                Route::post('/store/{topic_id}', 'GamePageController@store')->name('game_page.store');
                Route::get('/edit/{id}', 'GamePageController@edit')->name('game_page.edit');
                Route::post('/update/{id}', 'GamePageController@update')->name('game_page.update');
                Route::post('/activate/{id}', 'GamePageController@activate')->name('game_page.activate');

                Route::get('/question/create/{game_id}', 'GamePageController@questionCreate')->name('question.create');
                Route::post('/question/question/store/{game_id}', 'GamePageController@questionStore')->name('question.store');                
                Route::get('/question/edit/{id}', 'GamePageController@questionEdit')->name('question.edit');
                Route::post('/question/update/{id}', 'GamePageController@questionUpdate')->name('question.update');
                Route::post('/question/activate/{id}', 'GamePageController@activate')->name('question.activate');
                
            });
            
            Route::group(['prefix' => 'explanation_page'], function() {
                Route::get('/create/{resource_id}', 'ExplanationPageController@create')->name('explanation_page.create');
                Route::post('/store/{resource_id}', 'ExplanationPageController@store')->name('explanation_page.store');
                Route::get('/edit/{id}', 'ExplanationPageController@edit')->name('explanation_page.edit');
                Route::post('/update/{id}', 'ExplanationPageController@update')->name('explanation_page.update');
                Route::post('/activate/{id}', 'ExplanationPageController@activate')->name('explanation_page.activate');
            });

            // Route::post('/store', 'AdditionalResourcesController@store')->name('student_resources.store');
            // Route::get('/edit/{id}', 'AdditionalResourcesController@edit')->name('student_resources.edit');
            // Route::post('/update/{id}', 'AdditionalResourcesController@update')->name('student_resources.update');
            // Route::post('/activate/{id}', 'AdditionalResourcesController@activate')->name('student_resources.activate');
        });


        // Student Resources
        Route::group(['prefix' => 'teacher_resources'], function() {
            
            Route::get('/', 'TeacherResourcesController@index')->name('teacher_resources.index');
            Route::get('/course/create', 'TeacherResourcesController@create')->name('teacher_resources.create');
            Route::post('/course/store', 'TeacherResourcesController@store')->name('teacher_resources.store');
            Route::get('/course/edit/{id}', 'TeacherResourcesController@edit')->name('teacher_resources.edit');
            Route::post('/course/update/{id}', 'TeacherResourcesController@update')->name('teacher_resources.update');
            
            Route::get('/course/{id}', 'TeacherResourcesController@course')->name('teacher_resources.course');
            Route::post('/sort', 'TeacherResourcesController@sortParts')->name('teacher_resources.sort');
            Route::post('/activate/{id}', 'TeacherResourcesController@activate')->name('teacher_resources.activate');

            Route::get('/question/create/{id}/{type}', 'QuestionController@questionCreate')->name('teacher_resources.question.create');
            Route::post('/question/question/store/{id}/{type}', 'QuestionController@questionStore')->name('teacher_resources.question.store');
            Route::get('/question/edit/{id}', 'QuestionController@questionEdit')->name('teacher_resources.question.edit');
            Route::post('/question/update/{id}', 'QuestionController@questionUpdate')->name('teacher_resources.question.update');
            Route::post('/question/activate/{id}', 'QuestionController@activate')->name('teacher_resources.question.activate');

            Route::group(['prefix' => 'part'], function() {
                Route::get('/create/{course_id}', 'PartController@create')->name('part.create');
                Route::post('/store/{course_id}', 'PartController@store')->name('part.store');
                Route::get('/edit/{id}', 'PartController@edit')->name('part.edit');
                Route::post('/update/{id}', 'PartController@update')->name('part.update');
                Route::post('/activate/{id}', 'PartController@activate')->name('part.activate');
            });
            
        });

    });
    
});


Route::get('lang/{lang}', 'Localization\LocalizationController@switch')->name('lang.switch');

Route::group(
    [
        'prefix' => \Localization::locale(),
        'where' => ['locale' => '[a-zA-Z]{2}'],
        'middleware' => 'localization'
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::group(['middleware' => 'auth'], function() {

            Route::get('/profile', 'Front\ProfileController@index')->name('profile');

        });

        Auth::routes();        
        Route::get('/register-success', 'Auth\RegisterController@verifyUser')->name('verify');

        // Send a reset password mail
        Route::post('/resetemail','Auth\ResetPasswordController@resetEmail')->name('password.reset');
        // Reset password page
        Route::get('/password/change','Auth\ResetPasswordController@passwordreset')->name('password.reset.page');
        // Reset password logic
        Route::post('/password/reset','Auth\ResetPasswordController@reseting')->name('password.reseting');

        
        Route::group(['prefix' => 'topics'], function() {
            Route::get('/', 'Front\TopicController@index')->name('topics');
            Route::get('/inner/{id}/{page?}', 'Front\TopicController@inner')->name('topics.inner');
            Route::get('/explanation/{id}', 'Front\TopicController@explanation')->name('topics.explanation');
        });

        Route::group(['prefix' => 'courses'], function() {
            Route::get('/inner/{id}/{page?}', 'Front\CourseController@inner')->name('course.inner');
            Route::get('/start/{id}', 'Front\CourseController@start')->name('course.start');
            Route::post('/next', 'Front\CourseController@next')->name('course.next');
            Route::get('/quiz/{course_id}', 'Front\CourseController@quiz')->name('course.quiz');
        });

        Route::get('/resources', 'Front\ResourceController@index')->name('resources');
        Route::get('/abouts/{page?}', 'Front\AboutController@index')->name('abouts');
        Route::get('/search', 'Front\SearchController@index')->name('search');

        Route::get('/get-pages', 'Front\TopicController@getPages')->name('topic.pages');

        Route::get('/privacy', function() {
            return view('web.frontend.sections.privacy');
        })->name('privacy');

        Route::get('/termsOfUse', function() {
            return view('web.frontend.sections.termsOfUse');
        })->name('termsOfUse');
        
        // Route::get('/resources/search', 'Front\ResourceController@search')->name('resources.search');
    }
);