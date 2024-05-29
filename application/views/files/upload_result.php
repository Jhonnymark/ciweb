<!DOCTYPE html>
<html>
<head>
    <title>Image Upload Results</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div>
        <?php echo var_dump($image_metadata);?>
        <h3>Congratulations, the image has successfully been uploaded</h3>
        <p>Click here to view the image you just uploaded
            <?php echo anchor('../images/'.$image_metadata['file_name'], 'View My Image!')?>
        </p>

        <p>
            <?php echo anchor('ImageUploadController', 'Go back to Image Upload'); ?>
        </p>
    </div>
</body>
</html>