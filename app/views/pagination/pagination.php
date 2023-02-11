<?php if ($total_pages > 1) { $uri = $_SERVER['REQUEST_URI']; ?>
  <ul class="pagination">
    <li class="page-item <?php if ($p == 1) { echo "disabled"; } ?>">
      <a class="page-link" href="?p=1" tabindex="-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <polyline points="15 6 9 12 15 18"></polyline>
        </svg>
      </a>
    </li>

    <?php for ($i=1; $i <= $total_pages; $i++) { ?>
      <li class="page-item <?php if ($p == $i) { echo "active"; } ?>"><a class="page-link" href="?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } ?>

    <li class="page-item">
      <a class="page-link" href="?p=<?php echo $total_pages; ?>" tabindex="-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <polyline points="9 6 15 12 9 18"></polyline>
        </svg>
      </a>
    </li>
  </ul>
<?php } ?>