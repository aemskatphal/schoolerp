<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Birthday Banner - <?php echo html_escape($system_name);?></title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: Arial, Helvetica, sans-serif; color: #000; font-size: 12px; }
  .banner {
    width: 297mm;
    height: 210mm;
    padding: 10mm;
    page-break-after: always;
    page-break-inside: avoid;
  }
  .banner:last-child { page-break-after: auto; }
  .banner-inner {
    width: 100%;
    height: 100%;
    border: 4px solid #e91e63;
    border-radius: 14px;
    padding: 8mm 12mm;
    position: relative;
    text-align: center;
    background: #fff;
    overflow: hidden;
  }
  .header {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10mm;
    border-bottom: 2px solid #e91e63;
    padding-bottom: 4mm;
  }
  .header .logo { width: 24mm; height: 24mm; }
  .header .logo img { width: 100%; height: 100%; object-fit: contain; }
  .header .title-box { text-align: center; }
  .header .tagline { font-size: 9px; letter-spacing: 1px; }
  .header .trust { font-size: 10px; }
  .header .school { font-size: 17px; font-weight: bold; }
  .header .addr { font-size: 11px; font-style: italic; }
  .greet {
    font-size: 34px;
    font-weight: bold;
    letter-spacing: 6px;
    color: #e91e63;
    margin-top: 6mm;
  }
  .photo {
    width: 68mm;
    height: 68mm;
    margin: 8mm auto 0;
    border: 3px solid #e91e63;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
  }
  .photo img { width: 100%; height: 100%; object-fit: cover; }
  .name {
    font-size: 28px;
    font-weight: bold;
    text-transform: uppercase;
    margin-top: 8mm;
  }
  .cls { font-size: 16px; margin-top: 3mm; font-weight: bold; }
  .meta { font-size: 12px; margin-top: 2mm; color: #555; }
  .footer {
    position: absolute;
    bottom: 6mm;
    left: 0;
    width: 100%;
    text-align: center;
    font-size: 10px;
    color: #999;
  }
  @media print {
    body { -webkit-print-color-adjust: exact; }
    @page { size: A4 landscape; margin: 0; }
  }
</style>
</head>
<body>
<?php foreach($students as $row): ?>
  <div class="banner">
    <div class="banner-inner">
      <div class="header">
        <div class="logo"><img src="<?php echo base_url('uploads/logo.png');?>" alt="logo" /></div>
        <div class="title-box">
          <div class="tagline">YOU ARE THE SCULPTOR OF YOUR LIFE</div>
          <div class="trust">Sadguru Shree Wamanrao Pai Shikshan Sanstha</div>
          <div class="school">ACHARYA ENGLISH MEDIUM SCHOOL AND JR. COLLEGE</div>
          <div class="addr">Suryanagari, Jalochi, Tal-Baramati, Dist-Pune</div>
        </div>
      </div>
      <div class="greet">HAPPY BIRTHDAY</div>
      <div class="photo">
        <?php if(!empty($row['photo'])): ?>
          <img src="<?php echo base_url('uploads/student_image/'.html_escape($row['photo']));?>" alt="student" />
        <?php else: ?>
          <img src="<?php echo base_url('uploads/default.png');?>" alt="student" />
        <?php endif; ?>
      </div>
      <div class="name"><?php echo html_escape($row['name']);?></div>
      <div class="cls"><?php echo html_escape($row['class_name'] ?? '');?></div>
      <div class="meta">
        Ad. Year: <?php echo html_escape($row['ad_year']);?>
        &nbsp;|&nbsp;
        Birthday: <?php echo html_escape($row['birthday_display']);?>
      </div>
      <div class="footer">Wishing you a day full of happiness and a year full of joy!</div>
    </div>
  </div>
<?php endforeach; ?>
</body>
</html>
