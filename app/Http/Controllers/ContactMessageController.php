<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);

        return view('contact-messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.contact', ['contactMessage' => new ContactMessage()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ContactMessage::create($this->validatedData($request));

        return redirect()->route('contact')->with('success', 'Your message was sent.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage)
    {
        return view('contact-messages.show', compact('contactMessage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactMessage $contactMessage)
    {
        return view('contact-messages.edit', compact('contactMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        $contactMessage->update($this->validatedData($request) + [
            'is_resolved' => $request->boolean('is_resolved'),
        ]);

        return redirect()->route('contact-messages.show', $contactMessage)->with('success', 'Contact message updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('contact-messages.index')->with('success', 'Contact message deleted.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'subject' => ['required', 'string', 'max:140'],
            'message' => ['required', 'string', 'min:10'],
        ]);
    }
}
