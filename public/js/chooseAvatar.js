document.getElementById('profileImage').addEventListener('click', function() {
    document.getElementById('avatarInput').click();
  });

  document.getElementById('avatarInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const imagePreview = document.getElementById('profileImage');
        imagePreview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });