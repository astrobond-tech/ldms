<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\DocumentComment;
use App\Models\DocumentHistory;
use App\Models\LoggedHistory;
use App\Models\Notification;
use App\Models\Reminder;
use App\Models\shareDocument;
use App\Models\Stage;
use App\Models\SubCategory;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\User;
use App\Models\DocumentEssential;
use App\Models\VersionHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Mail;

class DocumentController extends Controller
{

    public function index(Request $request)
    {
        if (\Auth::user()->can('manage document')) {
            $category = Category::where('parent_id', parentId())->get()->pluck('title', 'id')->prepend(__('Select Category'), '');
            $stages = Stage::where('parent_id', parentId())->get()->pluck('title', 'id')->prepend(__('Select Stage'), '');
            $documents_query = Document::where('parent_id', '=', parentId())->where('archive', 0);
            if (!empty($request->category)) {
                $documents_query->where('category_id', $request->category);
            }
            if (!empty($request->stages)) {
                $documents_query->where('stage_id', $request->stages);
            }
            if (!empty($request->created_date)) {
                $documents_query->whereDate('created_at', $request->created_date);
            }
            $documents = $documents_query->OrderBy('id', 'desc')->get();
            session()->flashInput($request->input());
            return view('document.index', compact('documents', 'category', 'stages'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function create()
    {
        $category = Category::where('parent_id', parentId())->get()->pluck('title', 'id');
        $category->prepend(__('Select Category'), '');
        $tages = Tag::where('parent_id', parentId())->get()->pluck('title', 'id');
        $stage_id = Stage::where('parent_id', parentId())->get()->pluck('title', 'id');
        $client = User::where('parent_id', parentId())->where('type', 'client')->get()->mapWithKeys(function ($user) {
            return [$user->id => $user->first_name . ' ' . $user->last_name];
        });
        return view('document.create', compact('category', 'tages', 'client', 'stage_id'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create document') || \Auth::user()->can('create my document')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'category_id' => 'nullable',
                    'sub_category_id' => 'nullable',
                    'document' => 'nullable',
                    'stage_id' => 'nullable',
                    'assign_to' => 'nullable',
                    'document_type' => 'required|in:book,document,paper_cutting',
                    'copies_total' => 'nullable|integer',
                    'copies_available' => 'nullable|integer',
                    'rack' => 'nullable|string',
                    'shelf' => 'nullable|string',
                    'room' => 'nullable|string',
                    'cabinet' => 'nullable|string',
                    'author' => 'nullable|string',
                    'publisher' => 'nullable|string',
                    'isbn' => 'nullable|string',
                    'language' => 'nullable|string',
                    'published_year' => 'nullable|integer',
                    'newspaper_name' => 'nullable|string',
                    'clipping_date' => 'nullable|date',
                    'headline' => 'nullable|string',
                    'section' => 'nullable|string',
                    'forwarded_to' => 'nullable|string',
                    'doc_category' => 'nullable|string',
                    'ref_number' => 'nullable|string',
                    'file_number' => 'nullable|string',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $ids = parentId();
            $authUser = \App\Models\User::find($ids);
            $totalDocument = $authUser->totalDocument();
            $subscription = Subscription::find($authUser->subscription);
            if ($totalDocument >= $subscription->total_document && $subscription->total_document != 0) {
                return redirect()->back()->with('error', __('Your document limit is over, please upgrade your subscription.'));
            }

            $document = new Document();
            $document->name = $request->name;
            $document->stage_id = $request->stage_id;
            $document->assign_to = $request->assign_to;
            $document->category_id = $request->category_id;
            $document->sub_category_id = $request->sub_category_id;
            $document->description = $request->description;
            $document->tages = !empty($request->tages) ? implode(',', $request->tages) : '';
            $document->created_by = \Auth::user()->id;
            $document->parent_id = parentId();
            $document->save();

            $essential = new DocumentEssential();
            $essential->document_id = $document->id;
            $essential->document_type = $request->document_type;
            $essential->copies_total = $request->copies_total;
            $essential->copies_available = $request->copies_available;
            $essential->rack = $request->rack;
            $essential->shelf = $request->shelf;
            $essential->room = $request->room;
            $essential->cabinet = $request->cabinet;
            $essential->author = $request->author;
            $essential->publisher = $request->publisher;
            $essential->isbn = $request->isbn;
            $essential->language = $request->language;
            $essential->published_year = $request->published_year;
            $essential->newspaper_name = $request->newspaper_name;
            $essential->clipping_date = $request->clipping_date;
            $essential->headline = $request->headline;
            $essential->section = $request->section;
            $essential->forwarded_to = $request->forwarded_to;
            $essential->doc_category = $request->doc_category;
            $essential->ref_number = $request->ref_number;
            $essential->file_number = $request->file_number;
            $essential->save();

            if ($request->hasFile('document')) {
                $uploadResult = handleFileUpload($request->file('document'), 'upload/document');

                if ($uploadResult['flag'] == 0) {
                    return redirect()->back()->with('error', $uploadResult['msg']);
                }
                $version = new VersionHistory();
                $version->document = $uploadResult['filename'];
                $version->current_version = 1;
                $version->document_id = $document->id;
                $version->created_by = \Auth::user()->id;
                $version->parent_id = parentId();
                $version->save();
            }

            $data['document_id'] = $document->id;
            $data['action'] = __('Document Create');
            $data['description'] = __('New document') . ' ' . $document->name . ' ' . __('created by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', __('Document successfully created!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function show($cid)
    {
        $id = Crypt::decrypt($cid);
        $document = Document::with('essential')->find($id);
        $latestVersion = VersionHistory::where('document_id', $id)->where('current_version', 1)->first();
        return view('document.show', compact('document', 'latestVersion'));
    }


    public function edit($id)
    {
        $id = decrypt($id);
        $document = Document::with('essential')->find($id);

        $category = Category::where('parent_id', parentId())->get()->pluck('title', 'id');
        $category->prepend(__('Select Category'), '');
        $tages = Tag::where('parent_id', parentId())->get()->pluck('title', 'id');

        $stage_id = Stage::where('parent_id', parentId())->get()->pluck('title', 'id');
        $client = User::where('parent_id', parentId())->where('type', 'client')->get()->mapWithKeys(function ($user) {
            return [$user->id => $user->first_name . ' ' . $user->last_name];
        });
        return view('document.edit', compact('document', 'category', 'tages', 'stage_id', 'client'));
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit document') || \Auth::user()->can('create my document')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'category_id' => 'nullable',
                    'sub_category_id' => 'nullable',
                    'stage_id' => 'nullable',
                    'assign_to' => 'nullable',
                    'document_type' => 'required|in:book,document,paper_cutting',
                    'copies_total' => 'nullable|integer',
                    'copies_available' => 'nullable|integer',
                    'rack' => 'nullable|string',
                    'shelf' => 'nullable|string',
                    'room' => 'nullable|string',
                    'cabinet' => 'nullable|string',
                    'author' => 'nullable|string',
                    'publisher' => 'nullable|string',
                    'isbn' => 'nullable|string',
                    'language' => 'nullable|string',
                    'published_year' => 'nullable|integer',
                    'newspaper_name' => 'nullable|string',
                    'clipping_date' => 'nullable|date',
                    'headline' => 'nullable|string',
                    'section' => 'nullable|string',
                    'forwarded_to' => 'nullable|string',
                    'doc_category' => 'nullable|string',
                    'ref_number' => 'nullable|string',
                    'file_number' => 'nullable|string',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $id = decrypt($id);
            $document = Document::find($id);
            $document->name = $request->name;
            $document->stage_id = $request->stage_id;
            $document->assign_to = $request->assign_to;
            $document->category_id = $request->category_id;
            $document->sub_category_id = $request->sub_category_id;
            $document->description = $request->description;
            $document->tages = !empty($request->tages) ? implode(',', $request->tages) : '';
            $document->save();

            $essential = DocumentEssential::firstOrNew(['document_id' => $document->id]);
            $essential->document_type = $request->document_type;
            $essential->copies_total = $request->copies_total;
            $essential->copies_available = $request->copies_available;
            $essential->rack = $request->rack;
            $essential->shelf = $request->shelf;
            $essential->room = $request->room;
            $essential->cabinet = $request->cabinet;
            $essential->author = $request->author;
            $essential->publisher = $request->publisher;
            $essential->isbn = $request->isbn;
            $essential->language = $request->language;
            $essential->published_year = $request->published_year;
            $essential->newspaper_name = $request->newspaper_name;
            $essential->clipping_date = $request->clipping_date;
            $essential->headline = $request->headline;
            $essential->section = $request->section;
            $essential->forwarded_to = $request->forwarded_to;
            $essential->doc_category = $request->doc_category;
            $essential->ref_number = $request->ref_number;
            $essential->file_number = $request->file_number;
            $essential->save();

            $data['document_id'] = $document->id;
            $data['action'] = __('Document Update');
            $data['description'] = __('Document update') . ' ' . $document->name . ' ' . __('updated by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', __('Document successfully created!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete document')) {
            $id = decrypt($id);
            $document = Document::find($id);
            $document->delete();
            $data['document_id'] = $document->id;
            $data['action'] = __('Document Delete');
            $data['description'] = __('Document delete') . ' ' . $document->name . ' ' . __('deleted by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            $versions = VersionHistory::where('document_id', $document->id)->get();
            if (!empty($versions)) {
                foreach ($versions as $key => $value) {
                    if (!empty($value->document)) {
                        deleteOldFile($value->document, 'upload/document/');
                    }
                }
            }
            VersionHistory::where('document_id', $document->id)->delete();

            return redirect()->back()->with('success', 'Document successfully deleted!');
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function myDocument()
    {
        if (\Auth::user()->can('manage my document')) {
            $assign_doc = shareDocument::where('user_id', \Auth::user()->id)->get()->pluck('document_id');

            $documents = Document::where('created_by', '=', \Auth::user()->id);
            if (!empty($assign_doc)) {
                $documents->orWhereIn('id', $assign_doc);
            }

            $documents = $documents->OrderBy('id', 'desc')->get();
            return view('document.own', compact('documents'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function comment($ids)
    {
        if (\Auth::user()->can('manage comment')) {
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $comments = DocumentComment::where('document_id', $id)->OrderBy('id', 'desc')->get();
            return view('document.comment', compact('document', 'comments'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function commentData(Request $request, $ids)
    {
        if (\Auth::user()->can('create comment')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'comment' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $comment = new DocumentComment();
            $comment->comment = $request->comment;
            $comment->user_id = \Auth::user()->id;
            $comment->document_id = $document->id;
            $comment->parent_id = parentId();
            $comment->save();

            $data['document_id'] = $document->id;
            $data['action'] = __('Comment Create');
            $data['description'] = __('Comment create for') . ' ' . $document->name . ' ' . __('commented by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', 'Document comment successfully created!');
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function reminder($ids)
    {
        if (\Auth::user()->can('manage reminder')) {
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $reminders = Reminder::where('document_id', $id)->OrderBy('id', 'desc')->get();
            $users = User::where('parent_id', parentId())->get()->pluck('name', 'id');
            return view('document.reminder', compact('document', 'reminders', 'users'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function addReminder($id)
    {
        if (\Auth::user()->can('create reminder')) {
            $document = Document::find($id);
            $reminders = Reminder::where('document_id', $id)->get();
            $users = User::where('parent_id', parentId())->get()->pluck('name', 'id');
            return view('document.add_reminder', compact('document', 'reminders', 'users'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function versionHistory($ids)
    {
        if (\Auth::user()->can('manage version')) {
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $versions = VersionHistory::where('document_id', $id)->OrderBy('id', 'desc')->get();

            return view('document.version_history', compact('document', 'versions'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function newVersion(Request $request, $ids)
    {
        if (\Auth::user()->can('create version')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'document' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $id = Crypt::decrypt($ids);

            VersionHistory::where('document_id', $id)->update(['current_version' => 0]);

            if ($request->hasFile('document')) {
                $uploadResult = handleFileUpload($request->file('document'), 'upload/document');

                if ($uploadResult['flag'] == 0) {
                    return redirect()->back()->with('error', $uploadResult['msg']);
                }
                $version = new VersionHistory();
                $version->document = $uploadResult['filename'];
                $version->current_version = 1;
                $version->document_id = $id;
                $version->created_by = \Auth::user()->id;
                $version->parent_id = parentId();
                $version->save();
            }

            $document = Document::find($id);
            $data['document_id'] = $id;
            $data['action'] = __('New version');
            $data['description'] = __('Upload new version for') . ' ' . $document->name . ' ' . __('uploaded by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', __('New version successfully uploaded!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function shareDocument($ids)
    {
        if (\Auth::user()->can('manage share document')) {
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $shareDocuments = shareDocument::where('document_id', $id)->OrderBy('id', 'desc')->get();
            $users = User::where('parent_id', parentId())->get()->pluck('name', 'id');
            return view('document.share', compact('document', 'shareDocuments', 'users'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function addshareDocumentData($id)
    {
        if (\Auth::user()->can('create share document')) {
            $id = decrypt($id);
            $document = Document::find($id);
            $shareDocuments = shareDocument::where('document_id', $id)->get();
            $users = User::where('parent_id', parentId())->get()->pluck('name', 'id');
            return view('document.add_share', compact('document', 'shareDocuments', 'users'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function shareDocumentData(Request $request, $ids)
    {
        if (\Auth::user()->can('create share document')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'assign_user' => 'required',
                ]
            );
            if (isset($request->time_duration)) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'start_date' => 'required',
                        'end_date' => 'required',
                    ]
                );
            }
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            foreach ($request->assign_user as $user) {
                $share = new shareDocument();
                $share->user_id = $user;
                $share->document_id = $request->document_id;
                if (!empty($request->start_date) && !empty($request->end_date)) {
                    $share->start_date = $request->start_date;
                    $share->end_date = $request->end_date;
                }
                $share->parent_id = parentId();
                $share->save();
            }
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $data['document_id'] = $id;
            $data['action'] = __('Share document');
            $data['description'] = __('Share document') . ' ' . $document->name . ' ' . __('shared by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            // Handle notifications and emails
            $module = 'document_share';
            $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
            $setting = settings();
            $errorMessage = '';
            if (!empty($notification) && $notification->enabled_email == 1) {
                $notification_responce = MessageReplace($notification, $request->document_id);

                // Fetch users and their emails
                $users = User::whereIn('id', $request->assign_user)->get();
                $to = $users->pluck('email')->toArray();

                if (!empty($to)) {
                    $datas = [
                        'user'    => $users,
                        'subject' => $notification_responce['subject'],
                        'message' => $notification_responce['message'],
                        'module'  => $module,
                        'logo'    => $setting['company_logo'],
                    ];
                    // Send emails to all recipients
                    $response = commonEmailSend($to, $datas);
                    if ($response['status'] == 'error') {
                        $errorMessage = $response['message'];
                    }
                }
            }

            return redirect()->back()->with('success', __('Document successfully assigned!') . '</br>' . $errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function shareDocumentDelete($id)
    {
        if (\Auth::user()->can('delete share document')) {
            $id = decrypt($id);
            $shareDoc = shareDocument::find($id);
            $document = Document::find($shareDoc->document_id);
            $shareDoc->delete();

            $data['document_id'] = $id;
            $data['action'] = __('Share document delete');
            $data['description'] = __('Share document') . ' ' . $document->name . ' ' . __('delete,deleted by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', 'Assigned document successfully removed!');
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function sendEmail($ids)
    {
        if (\Auth::user()->can('manage mail')) {
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);

            return view('document.send_email', compact('document'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function sendEmailData(Request $request, $ids)
    {
        if (\Auth::user()->can('send mail')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'email' => 'required',
                    'subject' => 'required',
                    'message' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            // Handle notifications and emails

            $to = $request->email;
            $errorMessage = '';
            if (!empty($to)) {
                $datas = [
                    'subject' => $request->subject,
                    'message' => $request->message,
                    'module'  => 'send_email',
                    'logo'    => settings()['company_logo'],
                ];

                // Send emails to all recipients
                $response = commonEmailSend($to, $datas);
                if ($response['status'] == 'error') {
                    $errorMessage = $response['message'];
                }
            }

            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $data['document_id'] = $id;
            $data['action'] = __('Mail send');
            $data['description'] = __('Mail send for') . ' ' . $document->name . ' ' . __('sended by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', __('Mail successfully sent!') . '</br>' . $errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function history()
    {
        $ids = parentId();
        $authUser = \App\Models\User::find($ids);
        $subscription = \App\Models\Subscription::find($authUser->subscription);

        if (\Auth::user()->can('manage document history') && $subscription->enabled_document_history == 1) {
            $histories = DocumentHistory::where('parent_id', parentId())->OrderBy('id', 'desc')->get();
            return view('document.history', compact('histories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function loggedHistory()
    {
        $ids = parentId();
        $authUser = \App\Models\User::find($ids);
        $subscription = \App\Models\Subscription::find($authUser->subscription);

        if (\Auth::user()->can('manage logged history') && $subscription->enabled_logged_history == 1) {
            $histories = LoggedHistory::where('parent_id', parentId())->OrderBy('id', 'desc')->get();
            return view('logged_history.index', compact('histories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function loggedHistoryShow($id)
    {
        if (\Auth::user()->can('manage logged history')) {
            $histories = LoggedHistory::find($id);
            return view('logged_history.show', compact('histories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function loggedHistoryDestroy($id)
    {
        if (\Auth::user()->can('delete logged history')) {
            $id = decrypt($id);
            $histories = LoggedHistory::find($id);
            $histories->delete();
            return redirect()->back()->with('success', 'Logged history succefully deleted!');
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function Sharelink($id)
    {
        if (\Auth::user()->can('share documents')) {
            return view('document.Sharelink', compact('id'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function GenerateSharelink(Request $request)
    {
        $id = $request->did;
        $data['exp_date'] = $request->exp_date;
        $data['password'] = $request->password;
        $data['today'] = date('Y-m-d');
        if (\Auth::user()->can('share documents')) {;
            $return['url'] = route('document.view', $id) . '?data=' . encrypt($data);
            return response()->json($return);
        } else {
            $return['url'] = __('Something went wrong! Please try again later.');
            return response()->json($return);
        }
    }

    public function view(Request $request, $id)
    {

        try {
            $id = decrypt($id);
            $data = decrypt($request->data);

            $exp_date = $data['exp_date'] ?? null;
            $password = $data['password'] ?? null;
            $today = $data['today'] ?? \Carbon\Carbon::now()->toDateString();

            $Document = Document::find($id);
            if (!$Document) return abort(404, 'Document not found.');

            // Check if expired
            if (!empty($exp_date) && $today > $exp_date) {
                return view('document.expired', compact('Document', 'today'));
            }

            // If password is required and not passed via form, show password form
            if (!empty($password)) {
                if (!$request->has('verified') || $request->input('verified') != 'true') {
                    return view('document.password', compact('id', 'exp_date', 'password', 'today', 'Document'));
                }
            }

            return view('document.view', compact('id', 'exp_date', 'password', 'today', 'Document'));
        } catch (\Exception $e) {
            return abort(403, 'Invalid or expired document access link.');
        }
    }


    public function validatePassword(Request $request, $id)
    {
        $id = decrypt($id);
        $data = decrypt($request->data);
        $password = $data['password'] ?? null;

        if ($request->input('password') === $password) {
            return redirect()->route('document.view', [
                'id' => encrypt($id),
                'data' => $request->data,
                'verified' => 'true'
            ]);
        }

        return back()->withErrors(['password' => 'Incorrect password']);
    }

    public function archive(Request $request, $id)
    {
        if (\Auth::user()->can('archive document')) {
            $id = decrypt($id);
            $document = Document::find($id);
            if (!empty($document)) {
                $document->update(['archive' => 1]);
                return redirect()->back()->with('success', __('Document successfully archived!'));
            } else {
                return redirect()->back()->with('error', __('Document not found.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function unarchive(Request $request, $id)
    {
        if (\Auth::user()->can('archive document')) {
            $id = decrypt($id);
            $document = Document::find($id);
            if (!empty($document)) {
                $document->update(['archive' => 0]);
                return redirect()->back()->with('success', __('Document successfully unarchived!'));
            } else {
                return redirect()->back()->with('error', __('Document not found.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function documentArchive(Request $request)
    {
        if (\Auth::user()->can('archive document')) {
            $category = Category::where('parent_id', parentId())->get()->pluck('title', 'id')->prepend(__('Select Category'), '');
            $stages = Stage::where('parent_id', parentId())->get()->pluck('title', 'id')->prepend(__('Select Stage'), '');
            $documents_query = Document::where('parent_id', '=', parentId())->where('archive', 1);
            if (!empty($request->category)) {
                $documents_query->where('category_id', $request->category);
            }
            if (!empty($request->stages)) {
                $documents_query->where('stage_id', $request->stages);
            }
            if (!empty($request->created_date)) {
                $documents_query->whereDate('created_at', $request->created_date);
            }
            $documents = $documents_query->OrderBy('id', 'desc')->get();
            session()->flashInput($request->input());
            return view('document.archive', compact('documents', 'category', 'stages'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }
}
