(function(){
  var KEY = {
    TAB: 9
  };

  var $textarea = $('#markdown');
  var $htmlResults = $('#mdResults');
  var lastVal = '';

  $('#generate').on('click', updateMarkdown);

  setInterval(updateMarkdown, 1000);

  $textarea.on('keydown', function(e){
    console.log(e);
    if(e.keyCode === KEY.TAB) {
      e.preventDefault();
      var start = $(this).get(0).selectionStart;
      var end = $(this).get(0).selectionEnd;

      // set textarea value to: text before caret + tab + text after caret
      $(this).val($(this).val().substring(0, start)
        + "\t"
        + $(this).val().substring(end));

      // put caret at right position again
      $(this).get(0).selectionStart =
        $(this).get(0).selectionEnd = start + 1;
    }
  });

  function updateMarkdown (e) {
    e && e.preventDefault();

    if(lastVal == $textarea.val()){
      return;
    }

    $.ajax({
      url: 'http://markd.co/md',
      data: {md: $textarea.val()},
      dataType: 'json',
      method: 'post'
    }).error(function(data){
        lastVal = $textarea.val();
      }).done(function (data) {
        lastVal = $textarea.val();
        $htmlResults.val(data.output);
      });
  };
})();
