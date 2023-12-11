<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Dompdf\Dompdf;
use Dompdf\Options;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        // Retrieve the invoice data from the database
        $invoice = Order::where('user_id',Auth()->id())->findOrFail($id);
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        
        // Generate the invoice PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('frontend.order.invoice', compact('invoice'))->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output the generated PDF
        return $dompdf->stream("$invoice->orderId.pdf");
    }
}
