<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/increment-download-count',[\App\Http\Controllers\ContactController::class,'incrementDownloadCount'])->name('incrementDownloadCount');
Route::get('/login',function (){ return redirect('portal/login'); })->name('login');
Route::get('/register',function (){ return redirect('portal/register'); })->name('register');
Route::get('/', [App\Http\Controllers\WebsiteController::class, 'index'])->name('website');
Route::get('/blog', [App\Http\Controllers\WebsiteController::class, 'blog'])->name('blog');
Route::get('/exam', [App\Http\Controllers\WebsiteController::class, 'exam'])->name('exam');
Route::get('/ebook', [App\Http\Controllers\WebsiteController::class, 'ebook'])->name('ebook');
Route::get('/notes', [App\Http\Controllers\WebsiteController::class, 'notes'])->name('notes');
Route::get('/categories', [App\Http\Controllers\WebsiteController::class, 'category_clouds'])->name('website.category_clouds');
Route::get('/category/{slug}', [App\Http\Controllers\WebsiteController::class, 'category'])->name('website.category');
Route::get('/author/{slug}', [App\Http\Controllers\WebsiteController::class, 'author'])->name('website.author');
Route::post('/comment', [App\Http\Controllers\HomeController::class, 'comment'])->name('website.comment');
Route::post('/comment-store', [App\Http\Controllers\ContactController::class, 'storeComment'])->name('comment.store');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'contact'])->name('website.contact');
Route::get('/about', [App\Http\Controllers\WebsiteController::class, 'about'])->name('website.about');
Route::post('/contact-form', [App\Http\Controllers\ContactController::class, 'storeContactForm'])->name('contact_form.store');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'index'])->name('profile');
Route::post('/update', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
Route::get('/subject/{slug}', [App\Http\Controllers\WebsiteController::class, 'subject'])->name('subject');
Route::get('/exam-category/{slug}', [App\Http\Controllers\WebsiteController::class, 'exam_category'])->name('exam_category');
Route::get('/clone/{id}', [App\Http\Controllers\WebsiteController::class, 'clone'])->name('ep.clone');
Route::get('/start/{id}', [App\Http\Controllers\WebsiteController::class, 'start'])->name('start');

Route::get('/test/{id}', [App\Http\Controllers\ExamController::class, 'index'])->name('test')->middleware('exam_paper_password');
Route::post('/test-pass', [App\Http\Controllers\ExamController::class, 'pass'])->name('test_pass');
Route::get('/results/{id}', [App\Http\Controllers\WebsiteController::class, 'results'])->name('results');
Route::get('/result/{result}', [App\Http\Controllers\WebsiteController::class, 'result'])->name('result');
Route::get('/rank/{id}', [App\Http\Controllers\WebsiteController::class, 'rank'])->name('rank');
Route::post('/check-test', [App\Http\Controllers\ExamController::class, 'checking'])->name('checking');

Route::post('/download', [App\Http\Controllers\ExamController::class, 'download'])->name('download');

Route::get('/question-pdf/{id}', [App\Http\Controllers\WebsiteController::class, 'generatePDFquestion'])->name('question');
Route::get('/rank-pdf/{id}', [App\Http\Controllers\WebsiteController::class, 'generatePDFrank'])->name('rankpdf');
Route::get('/resultCardPdf/{id}', [App\Http\Controllers\WebsiteController::class, 'generatePDFresultCardPdf'])->name('resultCardPdf');
Route::get('sitemap', function() {
    $sitemap = resolve("sitemap");
    $sitemap->add(route('website'), '2012-08-26T12:30:00+02:00', '1.0','daily');
    $sitemap->add(route('website.contact'), '2012-08-26T12:30:00+02:00', '0.99','daily');
    $sitemap->add(route('website.about'), '2012-08-26T12:30:00+02:00', '0.98','daily');
    $sitemap->add(route('blog'), '2012-08-26T12:30:00+02:00', '0.95','daily');
    $sitemap->add(route('exam'), '2012-08-26T12:30:00+02:00', '0.97','daily');
    $sitemap->add(route('ebook'), '2012-08-26T12:30:00+02:00', '0.96','daily');
    $sitemap->add(route('notes'), '2012-08-26T12:30:00+02:00', '0.94','daily');
    $sitemap->add(route('website.category_clouds'), '2012-08-26T12:30:00+02:00', '0.93','daily');
    $sitemap->add(route('login'), '2012-08-25T20:10:00+02:00', '0.8', 'monthly');
    $sitemap->add(route('register'), '2012-08-25T20:10:00+02:00', '0.8', 'monthly');
    $posts = Post::orderBy('updated_at', 'desc')->get();

    foreach ($posts as $post) {
        $sitemap->add(route('website.post',['slug' => $post->slug]), $post->updated_at, '0.9', 'monthly');
    }

    $sitemap->store('xml', 'sitemap');
    return redirect('/sitemap.xml');
});
Route::get('/{slug}', [App\Http\Controllers\WebsiteController::class, 'post'])->name('website.post');
