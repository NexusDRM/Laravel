<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Braintree\WebhookNotification;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;


class WebhookController extends Controller
{
  /**
   * Handle a Braintree webhook.
   *
   * @param  WebhookNotification  $webhook
   * @return Response
   */
  public function handleDisputeOpened(WebhookNotification $notification)
  {
      // Handle The Event
  }
}
