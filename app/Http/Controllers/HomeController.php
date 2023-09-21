<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Client;
use App\Models\Domain;
use App\Models\Email;
use App\Models\Provider;
use App\Models\Server;
use App\Models\SocialMedium;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class HomeController extends Controller
{
    public function index()
    {

        $domains = Domain::where('user_id', Auth::id())->selectRaw("count(id) as number_domains")->first();
        $clients = Client::where('user_id', Auth::id())->selectRaw("count(id) as number_clients")->first();
        $social_media = SocialMedium::where('user_id', Auth::id())->selectRaw("count(id) as number_social_media")->first();
        $certificates = Certificate::where('user_id', Auth::id())->selectRaw("count(id) as number_certificates")->first();
        $emails = Email::where('user_id', Auth::id())->selectRaw("count(id) as number_emails")->first();
        $providers = Provider::where('user_id', Auth::id())->selectRaw("count(id) as number_providers")->first();
        $servers = Server::where('user_id', Auth::id())->selectRaw("count(id) as number_servers")->first();
        $subscriptions = Subscription::where('user_id', Auth::id())->selectRaw("count(id) as number_subscriptions")->first();

        return view(
            'dashboard.dashboard',
            [
                'domains' => $domains,
                'clients' => $clients,
                'social_media' => $social_media,
                'certificates' => $certificates,
                'emails' => $emails,
                'providers' => $providers,
                'servers' => $servers,
                'subscriptions' => $subscriptions
            ]
        );
    }
    public function domainsExpired()
    {
        $now = now();

        if (!Auth::user()->is_admin) {
            $domainsExpired = Domain::where('user_id', Auth::id())->where('expiration_date', '<', $now)->get()->load('provider', 'client', 'server');
        } else {
            $domainsExpired = Domain::all()->where('expiration_date', '<', $now)->load('provider', 'client', 'server');
        }

        return Datatables()->of($domainsExpired)->make(true);
    }

    public function domainsExpiresSoon()
    {
        $now = now();
        $payment_date_add_days = date("Y-m-d", strtotime($now . "+ 1 months"));


        if (!Auth::user()->is_admin) {
            $domainsExpired = Domain::where('user_id', Auth::id())
                ->where('expiration_date', '<', $payment_date_add_days)
                ->where('expiration_date', '>', $now)
                ->get()->load('provider', 'client', 'server');
        } else {
            $domainsExpired = Domain::all()
                ->where('expiration_date', '<', $payment_date_add_days)
                ->where('expiration_date', '>', $now)
                ->load('provider', 'client', 'server');
        }

        return Datatables()->of($domainsExpired)->make(true);
    }

    public function getDonateDomains()
    {
        $date = Carbon::now();


        $domainsExpired = Domain::where('expiration_date', '<', $date->toDateString());
        $domainsExpiresSoon = Domain::whereBetween('expiration_date', [$date->toDateString(), $date->addMonth()->toDateString()]);
        $domainInForce = Domain::where('expiration_date', '>', $date->toDateString());

        if (!Auth::user()->is_admin) {
            $domainsExpired->where('user_id', Auth::id());
            $domainsExpiresSoon->where('user_id', Auth::id());
            $domainInForce->where('user_id', Auth::id());
        }

        return response()->json([
            'code' => 200,
            'data' => [
                [
                    'name' => 'Expirados',
                    'value' => $domainsExpired->count()
                ],
                [
                    'name' => 'Por expirar',
                    'value' => $domainsExpiresSoon->count()
                ],
                [
                    'name' => 'Vigentes',
                    'value' => $domainInForce->count()
                ],
            ],
            'message' => 'Request executed successfully'
        ], 200);
    }
}
