<?php
    session_start();

    function generateCaptcha() {
        $captcha = strtoupper(substr(md5(openssl_random_pseudo_bytes(16)), 15, 4)); // md5 is OK to use here-- we don't care about collisions.
        $_SESSION["captcha"] = $captcha;

        $im = imagecreatetruecolor(150, 75);

        $bg = imagecolorallocate($im, 220, 220, 220);
        $white = imagecolorallocate($im, 255, 255, 255);
        $black = imagecolorallocate($im, 0, 0, 0);

        // set background colour.
        imagefilledrectangle($im, 0, 0, 150, 75, $bg);

        // output text.
        imagettftext($im, 35, rand(-25,25), 10, 55, $black, './arial.ttf', $captcha);

        for ($i = 0; $i < 50; $i++) {
            //imagefilledrectangle($im, $i + $i2, 5, $i + $i3, 70, $black);
            imagesetthickness($im, rand(1, 5));
            imagearc(
                $im,
                rand(1, 300), // x-coordinate of the center.
                rand(1, 300), // y-coordinate of the center.
                rand(1, 300), // The arc width.
                rand(1, 300), // The arc height.
                rand(1, 300), // The arc start angle, in degrees.
                rand(1, 300), // The arc end angle, in degrees.
                (rand(0, 1) ? $black : $white) // A color identifier.
            );
        }

        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);
    }

    generateCaptcha();
?>
