<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Medien;
use App\Http\Resources\MedienResource;

class MedienController extends Controller
{
    /**
     * Medien-Startseite
     */
    public function index(Request $request)
    {
        return view('lms.medien');
    }


    public function getBooks(Request $request, $searchterm = "")
    {
        $result = [];
        $books = Medien::all();
        $searchterm = $this->makeSearchString($request->get('searchterm', false));
        $author = $this->makeSearchString($request->get('author', false));
        $title = $this->makeSearchString($request->get('title', false));
        $hSearch = [];
        if ($author) {
            $hSearch[] = ['author','like',$author];
        }

        if ($title) 
        {
            $hSearch[] = ['title','like',$title];
        }

        if ($searchterm) {
            return MedienResource::collection(Medien::where('title', 'like', $searchterm)->orWhere('author', 'like', $searchterm)->get());
        }
        return MedienResource::collection(Medien::where($hSearch)->get());
    }

    public function getBook(Request $request, $id)
    {
        return Medien::find($id)->toJson();
    }

    /**
     * Kleine Routine, die dafür sorgt, das ein text in der Datenbank
     * leicht gesucht werden kann.
     */
    private function makeSearchString($strToSearch)
    {
        if ($strToSearch) {
            $strToSearch = str_replace('%', '', $strToSearch);
            $strToSearch = str_replace('"', '', $strToSearch);
            $strToSearch = '%' . $strToSearch . '%';
        }
        return $strToSearch;
    }

    /**
     * Macht ein update und gibt das buch wieder zurück.
     */
    public function updateBook(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
        $params = $request->post();
        $id = $params['id'];
        $workbook = Medien::find($id);
        //unset()
        $workbook->fill($params);
        $workbook->isbn13 = $params['isbn13'];
        $workbook->save();
        return $this->getBook(request(), $id);
    }

    /**
     * Liest die Daten für ein Buch anhand der ISBN Nr. von einem google Service aus.
     * Konfiguration:
     * xisbn service : http://xisbn.worldcat.org/xisbnadmin/doc/api.htm
     * google Service: https://www.googleapis.com/books/v1/volumes?q=isbn
     * @return Array 
     */
    public function getIsbnData(Request $request, $isbn13)
    {
        if ($isbn13 == "t") {
            $isbn13 = "9783834815378";
        }

            //return ['author' => 'Hans-Juergen', 'title'=>"honeymoon"];
            //strFileName = '~/request.json';
        $return = [
            'author' => "", 'title' => "", 'sub_title' => "",
            'publishedDate' => "", 'page_count' => "",
            'thumbnail' => "", 'publisher' => "", 'isbn13' => $isbn13, "barcode" => ""
        ]; 
    
        // suche bei Google
        $strUrl = "https://www.googleapis.com/books/v1/volumes?q=isbn:";
        $strUrl .= $isbn13;

        $ch = curl_init(); // create curl resource
        curl_setopt($ch, CURLOPT_URL, $strUrl); // set url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //return the transfer as a string
        $output = curl_exec($ch); // $output contains the output string
        curl_close($ch); // close curl resource to free up system resources

        if ($output) {
            $result = json_decode($output, true);
            $bookinfo = array_first(array_get($result, 'items'));

            $return['author'] = "";
            $authors = array_get($bookinfo, 'volumeInfo.authors', []);
            {
                foreach ($authors as $author) {
                    $return['author'] .= $author . ', ';
                }
            }
            $return['author'] = trim($return['author'], ', ');
            $return['title'] = array_get($bookinfo, 'volumeInfo.title', '');
            $return['sub_title'] = array_get($bookinfo, 'volumeInfo.subtitle', '');
            $return['published_date'] = array_get($bookinfo, 'volumeInfo.publishedDate', '');
            $return['page_count'] = array_get($bookinfo, 'volumeInfo.pageCount', '');
            $return['selflink'] = array_get($bookinfo, 'selfLink');
            $return['thumbnail'] = array_get($bookinfo, 'volumeInfo.imageLinks.thumbnail');
                
                //dd($re)

            if ($return['selflink']) {
                $ch = curl_init(); // create curl resource 
                curl_setopt($ch, CURLOPT_URL, $return['selflink']); // set url 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //return the transfer as a string 
                $output = curl_exec($ch); // $output contains the output string 
                curl_close($ch); // close curl resource to free up system resources 
                    //file_put_contents($strFileName, $output);
                $result2 = json_decode($output, true);
                $return['publisher'] = array_get($result2, 'volumeInfo.publisher');
            }
        }
        return $return;
    }
}
