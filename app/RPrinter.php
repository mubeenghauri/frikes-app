<?php

namespace App;

// use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Log;
class RPrinter {

    function __construct() {
        date_default_timezone_set("Asia/Karachi");

        $this->connected = true;
        try {
            $connector = new WindowsPrintConnector("BlackC");
            $this->printer = new Printer($connector);
        } catch (\Exception $e) {
            Log::debug("[RPrinter] Unable to initiate connection to printer.");
            $this->connected = false;
            return false;
        }
    }

    public function feed($feed = 1) {
        $this->printer->feed($feed);
    }

    public function cut() {
        $this->printer->cut();
    }

    function printRecipt($data, $sid) {
            $items = $data['items'];
            $subtotal = $data['total'];
            $discount = $data['discount'];
            $discountP = $data['discount_per'];
            Log::debug("[RPRINTER] Got Data : ", $data);
            Log::debug($subtotal);
            if(!$this->connected) {
                return false;
            }


            // Init printer settings
            $this->printer->initialize();
            $this->printer->selectPrintMode();
            // Set margins
            // $this->printer->setPrintLeftMargin(1);
            // Print receipt headers
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            // Print logo
            // $this->printLogo();

            $this->printer->setEmphasis(true);
            $this->printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);

            $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            // $this->printer->feed();
            
            $this->printer->text("Frikes");
            $this->feed(2);
            $this->printer->selectPrintMode();
            // $this->printer->text("{$this->store->getAddress()}\n");
            $this->printer->text("Order ID : " . $sid . "\n");
            $this->printer->feed(1);
            // Print receipt title
            $this->printer->setEmphasis(true);
            $this->printer->text("ORDER RECEIPT\n");
            $this->printer->setEmphasis(true);
            $this->printer->feed(1);

            // print header

            $this->printer->setJustification(Printer::JUSTIFY_LEFT);
            $this->printer->text( str_pad('Item',  25) );

            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text(str_pad('Qty', 10));


            $this->printer->setJustification(Printer::JUSTIFY_RIGHT);
            $this->printer->text(str_pad('Total', 10, ' ', STR_PAD_LEFT));
            $this->printer->setEmphasis(false);
            $this->feed();

            $this->printer->setJustification(Printer::JUSTIFY_LEFT);
            $this->printer->text( str_pad('----',  25) );

            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text(str_pad('----', 10));


            $this->printer->setJustification(Printer::JUSTIFY_RIGHT);
            $this->printer->text(str_pad('------', 10, ' ', STR_PAD_LEFT));
            $this->printer->setEmphasis(false);
            $this->feed(2);

            $this->printer->setJustification(Printer::JUSTIFY_LEFT);
            $this->printer->selectPrintMode();
            foreach($items as $i) {
                
                $this->printer->text(str_pad($i['name'], 25));

                // $this->printer->setJustification(Printer::JUSTIFY_CENTER);
                $this->printer->text(str_pad($i['quantity'], 12));

                $this->printer->setJustification(Printer::JUSTIFY_RIGHT);
                $total = (int)$i['price'] * (int) $i['quantity'];
                $this->printer->text(str_pad((string) $total, 6, ' ', STR_PAD_LEFT));       

                $this->feed();         
            }

            $this->feed(2);
            // Print subtotal
            $this->printer->setEmphasis(true);
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            
            $this->printer->text(str_pad("Subtotal : ", 25)." ".str_pad($subtotal, 10, ' ', STR_PAD_LEFT));
            // $this->printer->text();

            // $this->printer->setEmphasis(false);
            $this->printer->feed();
            // Print tax
            $this->printer->text(str_pad("Discount % : ", 25)." ".str_pad($discountP, 10, ' ', STR_PAD_LEFT));
            // $this->printer->text();

            $this->printer->feed(2);
            // Print grand total
            $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $this->printer->text(str_pad("TOTAL : ", 5));
            $gt = (int) $subtotal - (int) $discount;

            Log::debug("GT = ".(string)$gt);
            $this->printer->text(str_pad((string) $gt, 1, ' ', STR_PAD_LEFT));
            $this->printer->feed(2);
            $this->printer->setEmphasis(false);
            $this->printer->selectPrintMode();

            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text("Thank You, Have a nice day !");
            $this->printer->feed();
            // Print receipt date
            $this->printer->text(date('j F Y h:i:s a'));
            $this->printer->feed(2);
            // Cut the receipt
            $this->printer->cut();
            $this->printer->pulse()
;            try {
                $this->printer->close();
            } catch (\Exception $e) {
                return false;
            }
    }

    public function xreport($products, $items, $subtotal, $discount, $date) {

        // foreach ($products as $name => $data) {
        //     Log::debug($name, $data);
        // }

            if(!$this->connected) {
                return false;
            }

            // Init printer settings
            $this->printer->initialize();
            $this->printer->selectPrintMode();
            // Set margins
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);

            $this->printer->setEmphasis(true);
            $this->printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);

            $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            // $this->printer->feed();
            
            $this->printer->text("Frikes");
            $this->feed(2);
            $this->printer->selectPrintMode();
            // $this->printer->text("{$this->store->getAddress()}\n");
            $this->printer->text($date);
            
            // $this->printer->text("Order ID : " . $sid . "\n");
            $this->printer->feed(2);
            // Print receipt title
            $this->printer->setEmphasis(true);
            $this->printer->text("X-REPORT\n");
            $this->printer->setEmphasis(true);
            $this->printer->feed(1);

            $this->printer->setEmphasis(true);
            $this->printer->text("Sales\n");
            // $this->printer->setEmphasis(false);
            $this->printer->feed(2);
            // print header
            $this->printer->selectPrintMode();

            $this->printer->setJustification(Printer::JUSTIFY_LEFT);
            $this->printer->text( str_pad('Product',  25) );

            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text(str_pad('Qty', 10));


            $this->printer->setJustification(Printer::JUSTIFY_RIGHT);
            $this->printer->text(str_pad('Price', 10, ' ', STR_PAD_LEFT));
            $this->printer->setEmphasis(false);
            $this->feed();

            $this->printer->setJustification(Printer::JUSTIFY_LEFT);
            $this->printer->text( str_pad('----',  25) );

            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text(str_pad('----', 10));


            $this->printer->setJustification(Printer::JUSTIFY_RIGHT);
            $this->printer->text(str_pad('------', 10, ' ', STR_PAD_LEFT));
            $this->printer->setEmphasis(false);
            $this->feed(2);

            $this->printer->setJustification(Printer::JUSTIFY_LEFT);
            $this->printer->selectPrintMode();
            foreach($products as $name => $data) {
                
                $this->printer->text(str_pad($name, 25));

                // $this->printer->setJustification(Printer::JUSTIFY_CENTER);
                $this->printer->text(str_pad($data['quantity'], 12));

                $this->printer->setJustification(Printer::JUSTIFY_RIGHT);
                // $total = (int)$i['price'] * (int) $i['quantity'];
                $this->printer->text(str_pad( $data['price'], 6, ' ', STR_PAD_LEFT));       

                $this->feed();         
            }

            $this->feed(2);
            // Print subtotal
            $this->printer->setEmphasis(true);
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            
            $this->printer->text(str_pad("Subtotal : ", 25)." ".str_pad($subtotal, 10, ' ', STR_PAD_LEFT));
            // $this->printer->text();

            // $this->printer->setEmphasis(false);
            $this->printer->feed();
            // Print tax
            $this->printer->text(str_pad("Discount : ", 25)." ".str_pad($discount, 10, ' ', STR_PAD_LEFT));
            // $this->printer->text();

            $this->printer->feed(2);
            // Print grand total
            $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $this->printer->text(str_pad("TOTAL : ", 5));
            $gt = (int) $subtotal - (int) $discount;

            Log::debug("GT = ".(string)$gt);
            $this->printer->text(str_pad((string) $gt, 1, ' ', STR_PAD_LEFT));
            $this->printer->feed(3);
            $this->printer->setEmphasis(false);
            $this->printer->selectPrintMode();

            $this->printer->setEmphasis(true);
            $this->printer->text("Items Status\n");
            // $this->printer->setEmphasis(false);
            $this->feed(2);
            // printing quantities
            $this->printer->setJustification(Printer::JUSTIFY_LEFT);
            $this->printer->text( str_pad('Item Name',  25) );

            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text(str_pad('Qty Remaining', 10));


            $this->printer->setJustification(Printer::JUSTIFY_RIGHT);
            $this->printer->text(str_pad('Warning', 10, ' ', STR_PAD_LEFT));
            $this->printer->setEmphasis(false);
            $this->feed();

            $this->printer->setJustification(Printer::JUSTIFY_LEFT);
            $this->printer->text( str_pad('-------',  25) );

            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text(str_pad('----------', 10));


            $this->printer->setJustification(Printer::JUSTIFY_RIGHT);
            $this->printer->text(str_pad('------', 10, ' ', STR_PAD_LEFT));
            $this->printer->setEmphasis(false);
            $this->feed(2);

            $this->printer->setJustification(Printer::JUSTIFY_LEFT);
            $this->printer->selectPrintMode();
            foreach($items as $i) {
                
                $this->printer->text(str_pad($i['name'], 25));

                // $this->printer->setJustification(Printer::JUSTIFY_CENTER);
                $this->printer->text(str_pad($i['qty'], 12));

                $this->printer->setJustification(Printer::JUSTIFY_RIGHT);
                // $total = (int)$i['price'] * (int) $i['quantity'];
                $this->printer->text(str_pad( $i['warn'], 6, ' ', STR_PAD_LEFT));       

                $this->feed();         
            }

            $this->feed(2);

            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text("xxxxxxxxx <3 xxxxxxxxx");
            $this->printer->feed();
            // Print receipt date
            $this->printer->text(date('j F Y h:i:s a'));
            $this->printer->feed(2);
            // Cut the receipt
            $this->printer->cut();
            try {
                $this->printer->close();
            } catch (\Exception $e) {
                return false;
            }

    }

    public function print() {
        // $profile = CapabilityProfile::load("simple");
        $connector = new WindowsPrintConnector("BlackC");
        $printer = new PRINTER($connector);

        // print_r($printer);

        try {
            $printer = new Printer($connector);
            $printer->setEmphasis(true);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);

            $printer->setUnderline();

            $printer->text("Nabeel Boss!\nNabeel Don\n$50,000\n");
            $printer->feed(3);
            $printer->cut();
            $printer->close();
            echo "Closed";            
        } catch (\Exception $e) {
            echo "error";
            print_r($e);
        } finally {
            $printer->close();
        }

    }

    public function print2() {
        // Set params
        $mid = '123123456';
        $store_name = 'Frikes';
        $store_address = 'Mart Address';
        $store_phone = '1234567890';
        $store_email = 'yourmart@email.com';
        $store_website = 'yourmart.com';
        $tax_percentage = 10;
        $transaction_id = 'TX123ABC456';
        $currency = 'Rp';

        // Set items
        $items = [
            [
                'name' => 'French Fries (tera)',
                'qty' => 2,
                'price' => 65000,
            ],
            [
                'name' => 'Roasted Milk Tea (large)',
                'qty' => 1,
                'price' => 24000,
            ],
            [
                'name' => 'Honey Lime (large)',
                'qty' => 3,
                'price' => 10000,
            ],
            [
                'name' => 'Jasmine Tea (grande)',
                'qty' => 3,
                'price' => 8000,
            ],
        ];

        // Init printer
        $printer = new \ReceiptPrinter;
        $printer->init(
            config('receiptprinter.connector_type'),
            config('receiptprinter.connector_descriptor')
        );

        // Set store info
        $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);

        // Set currency
        $printer->setCurrency($currency);

        // Add items
        foreach ($items as $item) {
            $printer->addItem(
                $item['name'],
                $item['qty'],
                $item['price']
            );
        }
        // Set tax
        $printer->setTax($tax_percentage);

        // Calculate total
        $printer->calculateSubTotal();
        $printer->calculateGrandTotal();

        // Set transaction ID
        $printer->setTransactionID($transaction_id);

        // Set qr code
        $printer->setQRcode([
            'tid' => $transaction_id,
        ]);

        // Print receipt
        $printer->printReceipt();
    }

}