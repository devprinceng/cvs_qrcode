<?php
include('./phpqrcode/qrlib.php');


function generate($file, $fullname, $graduation_year, $regid, $department)
{

    $name = strtoupper($fullname);
    //sample cert path
    // $image_file = './uploads/newproject-cert.png';
    $image = imagecreatefromjpeg($file);

    // Set the font path
    $fontPath = './fonts/tabitha.ttf';
    $color = imagecolorallocate($image, 0, 0, 0);

    // Get the image dimensions
    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);

    // Generate the QR code and save it as a PNG file
    $qrCodeText = "UNIVERSITY OF CROSS RIVER STATE\nSTUDENT RESULT\n\nNAME: $name \nReg Number: $regid\nDepartment: $department\nGraduation year: $graduation_year\nVerification Link: \nhttp://certificate-verification-system-with-qrcode.test/verify?regid=$regid";

    $qrCodePath = '../user/qrcodes/qrcode-' . $name . '-' . time() . '-.png';
    // Define QR code size parameters
    $ecc = 'H'; // Error correction level: L, M, Q, H (low, medium, quartile, high)
    $pixelSize = 4; // Size of each pixel in the QR code
    $frameSize = 2; // Frame size around the QR code

    // Generate the QR code and save it as a PNG file with the specified size
    QRcode::png($qrCodeText, $qrCodePath, $ecc, $pixelSize, $frameSize);

    // Load the QR code image
    $qrcode = imagecreatefrompng($qrCodePath);

    // Get dimensions of the QR code image
    $qrcode_width = imagesx($qrcode);
    $qrcode_height = imagesy($qrcode);

    // Choose the position where the QR code should be placed
    $dst_x = 10; // X-coordinate of destination point
    $dst_y = 10; // Y-coordinate of destination point

    $qr_pos_x = ($imageWidth / 8) - 25;
    $qr_pos_y = $imageHeight - 920;

    imagettftext($image, 20, 90, (int)$qr_pos_x - 9, (int)$qr_pos_y + $qrcode_height + 160, $color, $fontPath, $regid);

    // Merge the QR code image onto the background image
    imagecopyresampled($image, $qrcode, (int)$qr_pos_x, $qr_pos_y, 0, 0, 200, 200, $qrcode_width, $qrcode_height);


    // Save the image or output it to the browser
    // header('Content-Type: image/png');
    $img_name = 'user/certificates/certificate-' . $name . '-' . time() . '.png';

    //generate image certificate
    if (imagepng($image, '../' . $img_name)) {
        // Free up memory
        imagedestroy($image);
        imagedestroy($qrcode);

        return $img_name;
    }

    return false;
}
