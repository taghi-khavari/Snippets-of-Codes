function runAjax( newTitle ){
  $.ajax({
      url: WPsettings.root + 'wp/v2/posts/' + WPsettings.current_ID,
      method : 'POST',
      beforeSend: function( xhr ){
        xhr.setRequestHeader( 'X-WP-Nonce' , WPsettings.nonce)
      }
      data: {
        'title': newTitle
      }
    });
  }
