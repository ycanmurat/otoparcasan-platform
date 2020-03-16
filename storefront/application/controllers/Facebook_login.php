<?defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook_login extends Core_Controller
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
			'redirectUri' => site_url('Facebook_login/callback'),
			'provider' => [
				'facebook' => [
					'applicationId' => getenv('FACEBOOK_APP_ID'),
					'applicationSecret' => getenv('FACEBOOK_APP_SECRET'),
					'scope' => ['email','user_likes','user_friends','user_link','public_profile'],
					'options' => [
		                'identity.fields' => [
		                    'email',
		                    'name',
		                    'picture.width(99999)'
		                ],
		            ],
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

		$this->load->model('Facebook_model','model');
	}

	public function index()
	{
		$provider_name = 'facebook';
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
		$getAllPosts = new stdClass();
		$providerName = 'facebook';
		$provider = $this->service->getProvider($providerName);
		$accessToken = $provider->getAccessTokenByRequestParameters($_GET);
		$user = $provider->getIdentity($accessToken);
		if ($this->model->userControl($user->email)) {
			if ($this->model->loginUser($user->email)) {
				redirect(site_url());
			} else {
				$this->session->flashdata('social_error','Facebooktan Bilgilerinizi Alamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.');
				redirect(site_url('User'));
			}
		} else {
			$getAllPosts->token = md5(date('Y-m-d H:i:s').$user->id);
			$info = explode(" ", $user->fullname);
			$getAllPosts->name = $info[0];
			$getAllPosts->surname = $info[1];
			$getAllPosts->email = $user->email;
			if ($this->model->addSocialUser($getAllPosts)) {
				redirect(site_url());
			} else {
				$this->session->flashdata('social_error','Facebooktan Bilgilerinizi Alamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.');
				redirect(site_url('User'));
			}
		}
	}
}