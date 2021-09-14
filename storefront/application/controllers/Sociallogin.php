<?defined('BASEPATH') OR exit('No direct script access allowed');

class Sociallogin extends Core_Controller
{
	private $configureProviders;
	private $service;
	private $httpClient;
	private $collectionFactory;

	function __construct()
	{
		parent::__construct();
		$this->checkSocialUserLogin();
		$this->configureProviders = [
			'redirectUri' => site_url('Sociallogin/callback'),
			'provider' => [
                'facebook' => [
                    'applicationId' => getenv('FACEBOOK_APP_ID'),
                    'applicationSecret' => getenv('FACEBOOK_APP_SECRET'),
                    'scope' => ['email','public_profile'],
                    'options' => [
                        'identity.fields' => [
                            'email',
                            'name',
                            'picture.width(99999)'
                        ],
                    ],
                ],
                'google' => [
                    'applicationId' => getenv('GOOGLE_CLIENT_ID'),
                    'applicationSecret' => getenv('GOOGLE_CLIENT_SECRET'),
                    'scope' => ['email','profile']
                ],
			],
		];

		$this->httpClient = new SocialConnect\Common\Http\Client\Curl;
		$this->service = new SocialConnect\Auth\Service(
			$this->httpClient,
			new SocialConnect\Provider\Session\Session(),
			$this->configureProviders
		);

		$this->collectionFactory = NULL;

		$this->service = new SocialConnect\Auth\Service(
			$this->httpClient,
			new SocialConnect\Provider\Session\Session(),
			$this->configureProviders,
			$this->collectionFactory
		);

		$this->load->model('Sociallogin_model','model');
	}

	public function index($provider_name)
	{
        $this->session->set_userdata('provider_name',$provider_name);
		if (!empty($provider_name) && !ctype_digit($provider_name)) {
			if (isset($this->configureProviders['provider'][$provider_name])){
				try {
					$provider = $this->service->getProvider($provider_name);
					if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], base_url()) !== FALSE) {
						$this->session->set_flashdata('login_redirect_url', $_SERVER['HTTP_REFERER']);
					}
					try {
						$auth_url = $provider->makeAuthUrl();
						header('Location:'. $auth_url);
					} catch (\Exception $e) {
						redirect(site_url('User'));
					}
				} catch (\Exception $e) {
					redirect(site_url('User'));
				}
			}
		} else {
			redirect(site_url('User'));
		}
	}

	public function callback()
	{
		$data = new stdClass();
        try {
            $provider_name = $this->session->userdata('provider_name');
            $this->session->unset_userdata('provider_name');
            $provider = $this->service->getProvider($provider_name);
            $accessToken = $provider->getAccessTokenByRequestParameters($_GET);
            $user = $provider->getIdentity($accessToken);
        } catch (\Exception $e) {
            $this->session->set_flashdata('social_error','Google dan Bilgilerinizi Alamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.');
            redirect(site_url());
        }

		if ($this->model->userControl($user->email)) {
			if ($this->model->loginUser($user->email)) {
				redirect(site_url());
			} else {
				$this->session->set_flashdata('social_error','Google dan Bilgilerinizi Alamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.');
				redirect(site_url('User'));
			}
		} else {
			$data->token = md5(date('Y-m-d H:i:s').$user->id);
			$info = explode(" ", $user->fullname);
			$data->name = $info[0];
			$data->surname = end($info);
            if (empty($user->email)) {
                $data->email = $user->id.'@fb.com';
            }else{
                $data->email = $user->email;
            }
            if ($this->model->addSocialUser($data)) {
                redirect(site_url());
            } else {
                $this->session->set_flashdata('social_error','Facebooktan Bilgilerinizi Alamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.');
                redirect(site_url('User'));
            }
		}
	}
}