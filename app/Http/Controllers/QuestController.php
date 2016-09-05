<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use DB;
use Validator;
use App\User;
use App\Quest;
use App\Http\Requests;

class QuestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        View::share('controller', 'quest');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quests = null;
        if (Auth::check()) {
            $quests = Quest::orderBy('created_at', 'DESC')->get();
        } else {
            $quests = Quest::orderBy('created_at', 'DESC')->get()->filter(function ($item) {
                return $item->author()->quests_public == 1;
            })->values();
        }
        return view('quests.index', [
            'quests' => $quests
        ]);
    }

    /**
     * Display a listing of the personal resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function overview()
    {
        $user = Auth::user();
        return view('quests.overview', [
              'accepted_quests' => $user->acceptedQuests,
              'resolved_quests' => $user->resolvedQuests,
              'checking_quests' => $user->checkingQuests,
              'created_quests' => $user->createdQuests,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quests.create');
    }

    /**
     * Show the form for parsing a new GitHub repository.
     *
     * @return \Illuminate\Http\Response
     */
    public function scan()
    {
        return view('repo.scan');
    }

    /**
     * Show the form for parsing a new GitHub repository.
     *
     * @return \Illuminate\Http\Response
     */
    public function parse(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'repo' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('repo.scan')
                      ->withErrors($validator)
                      ->withInput();
        }
        // $repo = urlencode($request->get('repo'));
        $repo = $request->get('repo');
        $repo = chop($repo, '.git');

        // return $repo;
        $query = 'http://bubbles-questifier.gpii.eu:3008/repository?url='.$repo;
        // $query = urlencode($query);

        // return $query;
        $ua = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6)
               AppleWebKit/537.36 (KHTML, like Gecko)
               Chrome/53.0.2785.89 Safari/537.36';
        $ua = 'Bubbles';

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $query);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 300);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, $ua);
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);

        $json = json_decode((string)$query);

        if (property_exists($json, 'status')) {
            if ((int)$json->status === 404) {
                return redirect()
                    ->route('repo.scan')
                    ->withInput();
            }
        } elseif (property_exists($json, 'repository')) {
            if (property_exists($json, 'files') && count($json->files)) {
                $files = $json->files;
                $data = array();
                foreach ($files as $fileKey => $file) {
                    $path = (string)$file->path;
                    if (property_exists($file, 'quests') && count($file->quests)) {
                        $quests = $file->quests;
                        foreach ($quests as $questKey => $quest) {
                            $text = $quest->text;
                            $line = explode("#L", $quest->line);
                            // Get the last element:
                            $line = $line[count($line) - 1];
                            $data[$path][] = array(
                              'text' => $text,
                              'line' => $line
                            );
                        }
                    }
                }
                return view('repo.selection', [
                  'repo' => $repo,
                  'data' => $data]);
            }
        } else {
            return redirect()
                ->route('repo.scan')
                ->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Quest::getValidationRules());
        $input = $request->all();
        $quest = Quest::create([
          'name' => $input['name'],
          'description' => $input['description'],
          'difficulty' => $input['difficulty'],
          'language' => $input['language'],
          'author_id' => $request->user()->id,
        ]);
        $quest->save();
      //     return view('quests.show', ['quest' => $quest]);
        return redirect()->route('quests.show', ['id' => $quest->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quest = Quest::find($id);
        if (is_null($quest)) {
            return redirect()->route('quests.index');
        }
        if (!Auth::check() && $quest->author()->quests_public == 0) {
            return redirect()->route('quests.index');
        }
        View::share('title', $quest->name);
        return view(
            'quests.show',
            ['quest' => $quest]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quest = Quest::find($id);
        if (is_null($quest) || (Auth::user()->id != $quest->author_id)) {
            return redirect()->route('quests.create');
        }
        return view('quests.edit', ['quest' => $quest ]);
    }

    /**
     * Accept a specific quest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $quest = Quest::find($id);
        if (is_null($quest)) {
            return redirect()->route('quests.create');
        }
        if ($quest->state != 'open') {
            return redirect()->route('quests.show', ['id' => $quest->id]);
        }
        if (Auth::user()->id == $quest->author_id) {
            return redirect()->route('quests.show', ['id' => $quest->id]);
        }
        $quest->editor_id = Auth::user()->id;
        $quest->state = 'wip';
        $quest->save();
        return redirect()->route('quests.show', ['id' => $quest->id]);
    }

    /**
     * Finish a specific quest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finish($id)
    {
        $quest = Quest::find($id);
        if (is_null($quest)) {
            return redirect()->route('quests.create');
        }
        if ($quest->state != 'wip') {
            return redirect()->route('quests.show', ['id' => $quest->id]);
        }
        if (Auth::user()->id != $quest->editor_id) {
            return redirect()->route('quests.show', ['id' => $quest->id]);
        }
        $quest->state = 'check';
        $quest->save();
        return redirect()->route('quests.show', ['id' => $quest->id]);
    }

    /**
     * Finish a specific quest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function close($id)
    {
        $quest = Quest::find($id);
        if (is_null($quest)) {
            return redirect()->route('quests.create');
        }
        if ($quest->state != 'check') {
            return redirect()->route('quests.show', ['id' => $quest->id]);
        }
        if (Auth::user()->id != $quest->author_id) {
            return redirect()->route('quests.show', ['id' => $quest->id]);
        }
        $quest->state = 'resolved';
        $quest->save();

        $user = User::find($quest->editor()->id);
        $user->points = $user->points + $quest->points;
        $user->save();

        return redirect()->route('quests.show', ['id' => $quest->id]);
    }

    /**
     * Reopen a specific quest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reopen($id)
    {
        $quest = Quest::find($id);
        if (is_null($quest)) {
            return redirect()->route('quests.create');
        }
        $isEditor = $quest->state == 'wip' && Auth::user()->id == $quest->editor_id;
        $isOwner = $quest->state == 'check' && Auth::user()->id == $quest->author_id;
        if ($isEditor || $isOwner) {
            $quest->editor_id = null;
            $quest->state = 'open';
            $quest->save();
        }
        return redirect()->route('quests.show', ['id' => $quest->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quest = Quest::find($id);
        if (is_null($quest) || ($request->user()->id != $quest->author_id)) {
            return redirect()->route('quests.create');
        }
        $this->validate($request, Quest::getValidationRules());
        Quest::find($id)->update($request->all());
        return redirect()->route('quests.show', ['id' => $quest->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quest = Quest::find($id);
        if (is_null($quest) || (Auth::user()->id != $quest->author_id)) {
            return redirect()->route('quests.create');
        }
        Quest::find($id)->delete();
        return redirect()->route('quests.index');
    }
}
