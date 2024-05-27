<?php
$jsonString = file_get_contents(URI . '/data/spec.json');
$data = json_decode($jsonString, true);
?>
<select class="wide search-select custom-select" name="specialization" required>
  <option value="" disabled="" selected="" class="">Fachrichtung</option>
  <?php foreach ($data as $value) : ?>
    <option value="<?php echo $value; ?>" class=""><?php echo $value; ?></option>
  <?php endforeach; ?>
</select>