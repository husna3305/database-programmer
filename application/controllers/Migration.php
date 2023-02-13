<?php



use GO\Scheduler;



class Migration extends CI_Controller
{



  public function __construct()
  {

    parent::__construct();

    $this->load->library('migration');

    $this->load->helper('file');
    $this->load->helper('auth');
    if (!logged_in()) redirect('auth');
  }



  public function version()
  {

    $data = [];

    $data['current_version'] = $this->db->from('migrations')->get()->row()->version;

    $data['migrations'] = $this->get_migrations();

    $this->load->view('migration/version', $data);
  }



  private function get_migrations()
  {

    $migrations = [];

    foreach ($this->migration->find_migrations() as $key => $value) {

      $array = [];

      $array['version'] = $key;

      $array['filename'] = basename($value);

      $migrations[] = $array;
    }

    return $migrations;
  }



  public function set_version($version)
  {

    $migration = $this->migration->version($version);
    if (!$migration) {
      echo $this->migration->error_string();
    } else {

      redirect(base_url('migration/version#current-version'), 'refresh');
    }
  }



  public function generate($filename = 'default')
  {

    $timestamp = date('YmdHis', time());

    $template = "<?php\n\n" . $this->load->view('migration/migration_class_template', [

      'className' => ucwords($filename)

    ], true);

    $filename = "{$timestamp}_$filename.php";

    $directory = APPPATH . 'migrations/';



    $file = fopen($directory . $filename, "w");

    fwrite($file, $template);

    fclose($file);
  }
}
