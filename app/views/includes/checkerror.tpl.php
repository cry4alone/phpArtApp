<?php
    $error = flash('error');
    $success = flash('success');
    if (!empty($error)) {
        echo '<div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 z-3" style="min-width: 300px;">';
        echo htmlspecialchars($error);
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
        echo '</div>';
    }
    if (!empty($success)) {
        echo '<div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 z-3" style="min-width: 300px;">';
        echo htmlspecialchars($success);
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
        echo '</div>';
    }
    unset($_SESSION['error']);
    unset($_SESSION['success']);
?>

<script>
  setTimeout(() => {
    const alert = document.querySelector('.alert');
    if (alert) {
      alert.remove();
    }
  }, 2000);
</script>