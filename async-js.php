add_filter('autoptimize_filter_js_defer','weblandtk_ao_override_defer');
function weblandtk_ao_override_defer($defer){
  return $defer." async ";
  }
