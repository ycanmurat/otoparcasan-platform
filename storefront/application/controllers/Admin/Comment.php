<?defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class Comment extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Comment_model','CM');
	}

	public function index()
	{
		$data = new StdClass;
		$data->mainMenu = 'FeedBack';
		$data->subMenu = 'reviewList';
		$data->reviews = $this->CM->getReviews();
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/review_list', $data);
		$this->load->view('Admin/footer');
	}

	public function deleteComment($id)
	{
		if ($this->CM->deleteComment($id)) {
			redirect(admin_url('Comment'));
		} else {
			redirect(admin_url('Comment'));
		}
	}

	public function addComment($id)
	{
		$data = new StdClass;
		$data->mainMenu = 'FeedBack';
		$data->subMenu = 'reviewList';
		$data->reviews = $this->CM->getReviewsById($id);
		$data->replys = $this->CM->getReplys();
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			$getAllPosts->review_id = $id;
			unset($getAllPosts->comment);
			if (empty($getAllPosts->quick_reply)) {
				unset($getAllPosts->quick_reply);
			} 
			if(empty($getAllPosts->answer)){
				$getAllPosts->answer = $getAllPosts->quick_reply;
				unset($getAllPosts->quick_reply);
			} else {
				unset($getAllPosts->quick_reply);
			}
			if (empty($getAllPosts->answer) && empty($getAllPosts->quick_reply)) {
				$this->session->set_flashdata('hata',2);
				redirect(admin_url('Comment'));
			}
			if ($this->CM->addComment($getAllPosts)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Comment'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Comment'));
			}
		}
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/review_reply', $data);
		$this->load->view('Admin/footer');
	}

	public function clearComment($id)
	{
		if ($this->CM->clearComment($id)) {
			redirect(admin_url('Comment'));
		} else {
			redirect(admin_url('Comment'));
		}
	}

	public function SetStatus($id,$new)
	{
		if ($this->CM->SetStatus($id,$new)) {
			redirect(admin_url('Comment'));
		} else {
			redirect(admin_url('Comment'));
		}
	}

	public function seenStatus($id,$seen)
	{
		if ($this->CM->seenStatus($id,$seen)) {
			redirect(admin_url('Comment'));
		} else {
			redirect(admin_url('Comment'));
		}
	}

	public function answerList()
	{
		$data = new StdClass;
		$data->mainMenu = 'FeedBack';
		$data->subMenu = 'answerList';

		$data->answers = $this->CM->getQuickReply();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/answer_list', $data);
		$this->load->view('Admin/footer');
	}

	public function answerAdd()
	{
		$data = new StdClass;
		$data->mainMenu = 'FeedBack';
		$data->subMenu = 'answerList';

		if ($this->input->post()) {
			$dataPost = $this->getAllPosts();
			if ($this->CM->addReply($dataPost)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Comment/answerAdd'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Comment/answerAdd'));
			}
		}

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/answer_add', $data);
		$this->load->view('Admin/footer');
	}

	public function deleteReply($id)
	{
		if ($this->CM->deleteReply($id)) {
			redirect(admin_url('Comment/answerList'));
		} else {
			redirect(admin_url('Comment/answerList'));
		}
	}

	public function SetStatusReply($id,$new)
	{
		if ($this->CM->SetStatusReply($id,$new)) {
			redirect(admin_url('Comment/answerList'));
		} else {
			redirect(admin_url('Comment/answerList'));
		}
	}

	public function editReply($id)
	{
		$data = new StdClass;
		$data->mainMenu = 'FeedBack';
		$data->subMenu = 'answerList';

		$data->reply = $this->CM->getReplyById($id);

		if ($this->input->post()) {
			$dataPost = $this->getAllPosts();

			if ($this->CM->updateReply($dataPost,$id)) {
				redirect(admin_url('Comment/answerList'));
			} else {
				redirect(admin_url('Comment/answerList'));
			}
		}

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/edit_reply', $data);
		$this->load->view('Admin/footer');
	}

	public function commentList()
	{
		$data = new StdClass;
		$data->mainMenu = 'Product';
		$data->subMenu = 'commentList';

		$data->comments = $this->CM->getAllComments();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/comment_list');
		$this->load->view('Admin/footer');
	}

	public function CommentseenStatus($id, $seen)
	{
		if ($this->CM->CommentseenStatus($id,$seen)) {
			redirect(admin_url('Comment/commentList'));
		} else {
			redirect(admin_url('Comment/commentList'));
		}
	}

	public function CommentSetStatus($id,$new)
	{
		if ($this->CM->CommentSetStatus($id,$new)) {
			redirect(admin_url('Comment/commentList'));
		} else {
			redirect(admin_url('Comment/commentList'));
		}
	}

	public function commentDelete($id)
	{
		if ($this->CM->commentDelete($id)) {
			redirect(admin_url('Comment/commentList'));
		} else {
			redirect(admin_url('Comment/commentList'));
		}
	}

	public function questionList()
	{
		$data = new StdClass;
		$data->mainMenu = 'Product';
		$data->subMenu = 'questionList';

		$data->questions = $this->CM->getQuestions();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/question_list');
		$this->load->view('Admin/footer');
	}

	public function SetQuestionStatus($id, $new)
	{
		if ($this->CM->SetQuestionStatus($id,$new)) {
			redirect(admin_url('Comment/questionList'));
		} else {
			redirect(admin_url('Comment/questionList'));
		}
	}

	public function seenStatusQuestion($id, $seen)
	{
		if ($this->CM->seenStatusQuestion($id,$seen)) {
			redirect(admin_url('Comment/questionList'));
		} else {
			redirect(admin_url('Comment/questionList'));
		}
	}

	public function deleteQuestion($id)
	{
		if ($this->CM->deleteQuestion($id)) {
			redirect(admin_url('Comment/questionList'));
		} else {
			redirect(admin_url('Comment/questionList'));
		}
	}

	public function addAnswer($id)
	{
		$data = new StdClass;
		$data->mainMenu = 'Product';
		$data->subMenu = 'questionList';
		$data->id = $id;
		$data->question = $this->CM->getIdByQuestion($id);
		$data->answers = $this->CM->getIdByAnswers($id);
		if ($this->input->post()) {
			$dataPost = $this->getAllPosts();
			$dataPost->added_time = Carbon::now()->setTimezone('Europe/Istanbul')->toDateTimeString();
			if ($this->CM->addAnswer($dataPost)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Comment/addAnswer/' . $id));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Comment/addAnswer/' . $id));
			}
		}

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/conversation_talk');
		$this->load->view('Admin/footer');
	}

	public function deleteAnswer($delete_id, $id)
	{
		if ($this->CM->deleteAnswer($delete_id)) {
			redirect(admin_url('Comment/addAnswer/' . $id));
		} else {
			redirect(admin_url('Comment/addAnswer/' . $id));
		}
	}

	public function questionAdd()
	{
		$data = new StdClass;
		$data->mainMenu = 'Product';
		$data->subMenu = 'questionList';
		$this->form_validation->set_rules('name', 'Kategori Adı', 'required|min_length[3]|max_length[250]');
		if ($this->form_validation->run() != FALSE) {
			$name = $this->input->post('name', true);
			if ($this->CM->addQuestion($name)) {
				$this->session->set_flashdata('onay', 1);
			} else {
				$this->session->set_flashdata('hata', 1);
			}
		}
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/product_question_add');
		$this->load->view('Admin/footer');
	}

	public function productQuestionList()
	{
		$data = new StdClass;
		$data->mainMenu = 'Product';
		$data->subMenu = 'questionList';
		$data->list = $this->CM->getProductQuestionList();
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/product_question_list');
		$this->load->view('Admin/footer');
	}

	public function editProductQuestionCategory($id)
	{
		$data = new StdClass;
		$data->mainMenu = 'Product';
		$data->subMenu = 'questionList';
		$data->category = $this->CM->getProductQuestionCategoryName($id);
		$this->form_validation->set_rules('name', 'Kategori Adı', 'required|min_length[3]|max_length[250]');
		if ($this->form_validation->run() != FALSE) {
			$name = $this->input->post('name', true);
			if ($this->CM->updateQuestion($name, $id)) {
				$this->session->set_flashdata('onay', 1);
			} else {
				$this->session->set_flashdata('hata', 1);
			}
		}
		$data->category = $this->CM->getProductQuestionCategoryName($id);
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/product_question_edit');
		$this->load->view('Admin/footer');
	}

	public function deleteProductQuestionCategory($id)
	{
		if ($this->CM->deleteProductQuestionCategory($id)) {
			redirect($this->agent->referrer());
		} else {
			redirect($this->agent->referrer());
		}
	}

	public function editProductQuestionStatus($id, $new_status) 
	{
		if ($this->CM->editProductQuestionStatus($id, $new_status)) {
			redirect($this->agent->referrer());
		} else {
			redirect($this->agent->referrer());
		}
	}

	public function readyTemplateAdd()
	{
		$data = new StdClass;
		$data->mainMenu = 'Product';
		$data->subMenu = 'questionList';
		$this->form_validation->set_rules('template', 'Şablon', 'required|min_length[3]');
		if ($this->form_validation->run() != FALSE) {
			$template = $this->input->post('template', true);
			if ($this->CM->readyTemplateAdd($template)) {
				$this->session->set_flashdata('onay', 1);
			} else {
				$this->session->set_flashdata('hata', 1);
			}
		}
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/product_question_ready_template_add');
		$this->load->view('Admin/footer');
	}

	public function productQuestionReadyTemplateList()
	{
		$data = new StdClass;
		$data->mainMenu = 'Product';
		$data->subMenu = 'questionList';
		$data->list = $this->CM->productQuestionReadyTemplateList();
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/product_question_ready_template_list');
		$this->load->view('Admin/footer');
	}

	public function editproductQuestionReadyTemplate($id)
	{
		$data = new StdClass;
		$data->mainMenu = 'Product';
		$data->subMenu = 'questionList';
		$data->template = $this->CM->editproductQuestionReadyTemplate($id);
		$this->form_validation->set_rules('template', 'Şablon', 'required|min_length[3]');
		if ($this->form_validation->run() != FALSE) {
			$template = $this->input->post('template', true);
			if ($this->CM->updateReadyTemplate($template, $id)) {
				$this->session->set_flashdata('onay', 1);
			} else {
				$this->session->set_flashdata('hata', 1);
			}
		}
		$data->template = $this->CM->editproductQuestionReadyTemplate($id);
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/product_question_ready_template_edit');
		$this->load->view('Admin/footer');
	}

	public function deleteproductQuestionReadyTemplate($id)
	{
		if ($this->CM->deleteproductQuestionReadyTemplate($id)) {
			redirect($this->agent->referrer());
		} else {
			redirect($this->agent->referrer());
		}
	}

	public function editProductReadyTemplateStatus($id, $new_status) 
	{
		if ($this->CM->editProductReadyTemplateStatus($id, $new_status)) {
			redirect($this->agent->referrer());
		} else {
			redirect($this->agent->referrer());
		}
	}
}