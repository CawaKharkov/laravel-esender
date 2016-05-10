<?php

namespace CawaKharkov\LaravelSender\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $dir;
    private $title;
    private $from;
    private $fromTitle;

    /**
     * SendEmail constructor.
     * @param $dir
     * @param $from
     * @param string $fromTitle
     * @param string $title
     */
    public function __construct($dir, $from, $fromTitle = 'Laravel sender', $title = 'Hello world!')
    {
        $this->dir = $dir;
        $this->from = $from;
        $this->fromTitle = $fromTitle;
        $this->title = $title;
    }

    /**
     * Execute the job.
     *
     * @param  Mailer $mailer
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        echo 'Sending email.' . PHP_EOL;

        if ($this->attempts() > 1) {
            $this->delete();
        }

        $users = $this->getUsers($this->dir.'/userlist.xlsx');

        $html = file_get_contents($this->dir.'/email.html');

        foreach ($users as $index => $user) {

            $index++;
            if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
                continue;
            }

            $mailer->send('laravel-sender::email.html', ['html' => $html],
                function ($m) use ($user) {
                    $m->from($this->from, $$this->fromTitle);

                    $m->to($user, null)->subject($this->title);
                });

            var_dump($user);
            if ($index % 10 === 0) {
                sleep(5);
            }
        }
        /*
        */
        echo 'end.' . PHP_EOL;
        $this->delete();
    }

    protected function getUsers($file)
    {
        $objPHPExcel = \PHPExcel_IOFactory::load($file);
        $users = $objPHPExcel->getActiveSheet()->toArray(false);

        return array_column($users, 0);
    }
}
