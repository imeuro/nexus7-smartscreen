<?php // calendar for the current month
$days_count = date('t');
$current_day = date('d');
$week_day_first = date('N', mktime(0, 0, 0, date('m'), 1, date('Y')));
?>
 
<div id="monthlycal">
  <ul class="cal-heading">
    <li>M</li>
    <li>T</li>
    <li>W</li>
    <li>T</li>
    <li>F</li>
    <li>S</li>
    <li>S</li>
  </ul>
  <?php for ($w = 1 - $week_day_first + 1; $w <= $days_count; $w = $w + 7): ?>
    <ul class="cal-days">
      <?php $counter = 0; ?>
      <?php for ($d = $w; $d <= $w + 6; $d++): ?>
        <li class="cal-day<?php if ($counter > 5): ?> holiday<?php endif; ?><?php if ($current_day == $d): ?> current<?php endif; ?>">
            <?php echo($d > 0 ? ($d > $days_count ? '' : $d) : '') ?>
        </li>
          <?php $counter++; ?>
      <?php endfor; ?>
    </ul>
  <?php endfor; ?>
</div>




<!--Add buttons to initiate auth sequence and sign out
<button id="authorize-button" style="display: none;">Authorize</button>
<button id="signout-button" style="display: none;">Sign Out</button>
-->

<ul id="content">
  <?php include('../logs/gcal.php') ?>
</ul>