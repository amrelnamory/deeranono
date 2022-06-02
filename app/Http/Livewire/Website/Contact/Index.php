<?php

namespace App\Http\Livewire\Website\Contact;

use App\Models\Contact;
use Livewire\Component;

class Index extends Component
{
    public $name;
    public $phone;
    public $email;
    public $subject;
    public $message;
    public $human;
    public $captchaQuestion;
    public $captchaAnswer;


    public function mount()
    {
        $randomInteger1 = substr(mt_rand(), 0, 2);
        $randomInteger2 = substr(mt_rand(), 0, 2);

        $captchaQuestion = sprintf('%s + %s =', $randomInteger1, $randomInteger2);

        $this->captchaQuestion = $captchaQuestion;

        $captchaAnswer = $randomInteger1 + $randomInteger2;
        $this->captchaAnswer = $captchaAnswer;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required',
            'phone' => 'required|digits:11',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|min:10',
            'human' => 'required|numeric|in:' . $this->captchaAnswer,
        ]);
    }

    public function render()
    {
        return view('livewire.website.contact.index');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required|digits:11',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|min:10',
            'human' => 'required|numeric|in:' . $this->captchaAnswer,
        ]);

        Contact::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);


        // Set Flash Message
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => __('site.message_sent_successfully')
        ]);

        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->subject = '';
        $this->message = '';

        $this->human = "";

        $randomInteger1 = substr(mt_rand(), 0, 2);
        $randomInteger2 = substr(mt_rand(), 0, 2);
        $captchaQuestion = sprintf('%s + %s =', $randomInteger1, $randomInteger2);
        $this->captchaQuestion = $captchaQuestion;
        $captchaAnswer = $randomInteger1 + $randomInteger2;
        $this->captchaAnswer = $captchaAnswer;
    }
}
