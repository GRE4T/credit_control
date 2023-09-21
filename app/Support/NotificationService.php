<?php
namespace App\Support;

use Carbon\Carbon;
use App\Mail\NotificationService as MailNotificationService;
use App\Models\Certificate;
use App\Models\Domain;
use App\Models\Email;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\NotificationService as ModelNotificationService;
use App\Models\Server;

trait NotificationService {

    public function certificates(){
        $previusDate = $this->dateExpiration();
        $certificates = Certificate::where('expiration_to', $previusDate)->get();
    
        if($certificates->count() > 0){
            foreach($certificates as $certificate){
                $arrayEmail = [
                    'name_user' => $certificate->user->name,
                    'expiration_date' => date('d-m-Y', strtotime($certificate->expiration_to)),
                    'entity' => 'Certificado',
                    'name_provider' => $certificate->provider->name,
                    'url' => url('certificates')
                ];

                //SEND EMAIL
                Mail::to($certificate->user->email)->send(new MailNotificationService($arrayEmail));
        
                //I save the notification in the database.
                $service = new ModelNotificationService();
                $service->service_type  = 'certificate';
                $service->service_id = $certificate->id;
                $service->expiration_date = $certificate->expiration_to;
                $service->email = $certificate->user->email;
                $service->save();

                Log::channel('notification_service')->info('CERTIFICADOS: Email enviado al siguiente usuario', ['email' => $service->email, 'expiration_date'=>$service->expiration_date]);
            }
        } else {
            Log::channel('notification_service')->notice('CERTIFICADOS: No se encontraron servicios por notificar', ['expiration_date' =>$previusDate]);
        }
    }

    public function domains(){
        $previusDate = $this->dateExpiration();
        $domains = Domain::where('expiration_date', $previusDate)->get();
    
        if($domains->count() > 0){
            foreach($domains as $domain){

                $arrayEmail = [
                    'name_user' => $domain->user->name,
                    'expiration_date' => date('d-m-Y', strtotime($domain->expiration_date)),
                    'entity' => 'Dominio',
                    'name_provider' => $domain->provider->name,
                    'url' => url('domains')
                ];

                //SEND EMAIL
                Mail::to($domain->user->email)->send(new MailNotificationService($arrayEmail));
        
                //I save the notification in the database.
                $service = new ModelNotificationService();
                $service->service_type  = 'domain';
                $service->service_id = $domain->id;
                $service->expiration_date = $domain->expiration_date;
                $service->email = $domain->user->email;
                $service->save();

                Log::channel('notification_service')->info('DOMINIO: Email enviado al siguiente usuario', ['email' => $service->email, 'expiration_date'=>$service->expiration_date]);
            }
        } else {
            Log::channel('notification_service')->notice('DOMINIO: No se encontraron servicios por notificar', ['expiration_date' =>$previusDate]);
        }
    }


    public function servers(){
        $previusDate = $this->dateExpiration();
        $servers = Server::where('expiration_date', $previusDate)->get();
    
        if($servers->count() > 0){
            foreach($servers as $server){

                $arrayEmail = [
                    'name_user' => $server->user->name,
                    'expiration_date' => date('d-m-Y', strtotime($server->expiration_date)),
                    'entity' => 'Servidor',
                    'name_provider' => $server->provider->name,
                    'url' => url('servers')
                ];

                //SEND EMAIL
                Mail::to($server->user->email)->send(new MailNotificationService($arrayEmail));
        
                //I save the notification in the database.
                $service = new ModelNotificationService();
                $service->service_type  = 'server';
                $service->service_id = $server->id;
                $service->expiration_date = $server->expiration_date;
                $service->email = $server->user->email;
                $service->save();

                Log::channel('notification_service')->info('SERVIDORES: Email enviado al siguiente usuario', ['email' => $service->email, 'expiration_date'=>$service->expiration_date]);
            }
        } else {
            Log::channel('notification_service')->notice('SERVIDORES: No se encontraron servicios por notificar', ['expiration_date' =>$previusDate]);
        }
    }

    public function emails(){
        $previusDate = $this->dateExpiration();
        $emails = Email::where('expiration_to', $previusDate)->get();
    
        if($emails->count() > 0){
            foreach($emails as $email){

                $arrayEmail = [
                    'name_user' => $email->user->name,
                    'expiration_date' => date('d-m-Y', strtotime($email->expiration_to)),
                    'entity' => 'Correo electrónico',
                    'name_provider' => $email->provider->name,
                    'url' => url('emails')
                ];

                //SEND EMAIL
                Mail::to($email->user->email)->send(new MailNotificationService($arrayEmail));
        
                //I save the notification in the database.
                $service = new ModelNotificationService();
                $service->service_type  = 'email';
                $service->service_id = $email->id;
                $service->expiration_date = $email->expiration_to;
                $service->email = $email->user->email;
                $service->save();

                Log::channel('notification_service')->info('CORREO ELECTRONICOS: Email enviado al siguiente usuario', ['email' => $service->email, 'expiration_date'=>$service->expiration_date]);
            }
        } else {
            Log::channel('notification_service')->notice('CORREO ELECTRONICOS: No se encontraron servicios por notificar', ['expiration_date' =>$previusDate]);
        }
    }


    /**
     * adds three days to the current date
     * @return String
     */
    private function dateExpiration(){
        $currentDate = Carbon::now();
        $counDay = config('bodegacloud.days_elepsed');
        return $currentDate->add($counDay, 'day')->toDateString();
    }

}