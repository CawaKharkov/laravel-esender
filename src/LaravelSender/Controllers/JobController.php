<?php

namespace CawaKharkov\LaravelSender\Controllers;


use App\Http\Controllers\Controller;
use CawaKharkov\LaravelSender\Jobs\SendEmail;
use CawaKharkov\LaravelSender\Models\EmailJob;
use CawaKharkov\LaravelSender\Requests\EmailJobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class JobController
 * @package CawaKharkov\LaravelSender\Controllers
 */
class JobController extends Controller
{

    public function index()
    {
        return view('laravel-sender::job.index', [
            'jobs' => EmailJob::all()->paginate()
        ]);
    }

    public function create()
    {
        return view('laravel-sender::job.create');
    }


    public function store(EmailJobRequest $request)
    {
        $path = storage_path('email/'.uniqid('job_',true));
        $from = $request->get('from');
        $title = $request->get('title');
        $fromTitle = $request->get('fromTitle');

        if ($request->file('userlist')->isValid()) {
            $request->file('userlist')->move($path, 'userlist.xlsx');

        }

        if ($request->file('template')->isValid()) {
            $request->file('template')->move($path, 'email.html');
        }

        $this->dispatch(new SendEmail($path,$from,$fromTitle,$title));

        return redirect()->route('sender.jobs.index');
    }
}