<?
$bot = new Snoopy();
define("wikiroot", "http://en.wikipedia.org/w/index.php?");
define("api", "http://en.wikipedia.org/w/api.php");
if ($linkto2) echo "\n// included DOItools2 & initialised \$bot\n";
define("doiRegexp", "(10\.\d{4}(/|%2F)..([^\s\|\"\?&>]|&l?g?t;|<[^\s\|\"\?&]*>))(?=[\s\|\"\?]|</)"); //Note: if a DOI is superceded by a </span>, it will pick up this tag. Workaround: Replace </ with \s</ in string to search.
define("timelimit", $fastMode?4:($slow_mode?15:10));
define("early", 8000);//Characters into the literated text of an article in which a DOI is considered "early".
define("siciRegExp", "~(\d{4}-\d{4})\((\d{4})(\d\d)?(\d\d)?\)(\d+):?([+\d]*)[<\[](\d+)::?\w+[>\]]2\.0\.CO;2~");

function list_parameters () { // Lists the parameters in order. 
    return Array(
     "null",
     "author", "author1", "last", "last1", "first", "first1", "authorlink", "authorlink1", "author1-link",
     "coauthors", "author2", "last2", "first2", "authorlink2", "author2-link",
     "author3", "last3", "first3", "authorlink3", "author3-link",
     "author4", "last4", "first4", "authorlink4", "author4-link",
     "author5", "last5", "first5", "authorlink5", "author5-link",
     "author6", "last6", "first6", "authorlink6", "author6-link",
     "author7", "last7", "first7", "authorlink7", "author7-link",
     "author8", "last8", "first8", "authorlink8", "author8-link",
     "author9", "last9", "first9", "authorlink9", "author9-link",
     "author10", "last10", "first10", "authorlink10", "author10-link",
     "author11", "last11", "first11", "authorlink11", "author11-link",
     "author12", "last12", "first12", "authorlink12", "author12-link",
     "author13", "last13", "first13", "authorlink13", "author13-link",
     "author14", "last14", "first14", "authorlink14", "author14-link",
     "author15", "last15", "first15", "authorlink15", "author15-link",
     "author16", "last16", "first16", "authorlink16", "author16-link",
     "author17", "last17", "first17", "authorlink17", "author17-link",
     "author18", "last18", "first18", "authorlink18", "author18-link",
     "author19", "last19", "first19", "authorlink19", "author19-link",
     "author20", "last20", "first20", "authorlink20", "author20-link",
     "author21", "last21", "first21", "authorlink21", "author21-link",
     "author22", "last22", "first22", "authorlink22", "author22-link",
     "author23", "last23", "first23", "authorlink23", "author23-link",
     "author24", "last24", "first24", "authorlink24", "author24-link",
     "author25", "last25", "first25", "authorlink25", "author25-link",
     "author26", "last26", "first26", "authorlink26", "author26-link",
     "author27", "last27", "first27", "authorlink27", "author27-link",
     "author28", "last28", "first28", "authorlink28", "author28-link",
     "author29", "last29", "first29", "authorlink29", "author29-link",
     "author30", "last30", "first30", "authorlink30", "author30-link",
     "author31", "last31", "first31", "authorlink31", "author31-link",
     "author32", "last32", "first32", "authorlink32", "author32-link",
     "author33", "last33", "first33", "authorlink33", "author33-link",
     "author34", "last34", "first34", "authorlink34", "author34-link",
     "author35", "last35", "first35", "authorlink35", "author35-link",
     "author36", "last36", "first36", "authorlink36", "author36-link",
     "author37", "last37", "first37", "authorlink37", "author37-link",
     "author38", "last38", "first38", "authorlink38", "author38-link",
     "author39", "last39", "first39", "authorlink39", "author39-link",
     "author40", "last40", "first40", "authorlink40", "author40-link",
     "author41", "last41", "first41", "authorlink41", "author41-link",
     "author42", "last42", "first42", "authorlink42", "author42-link",
     "author43", "last43", "first43", "authorlink43", "author43-link",
     "author44", "last44", "first44", "authorlink44", "author44-link",
     "author45", "last45", "first45", "authorlink45", "author45-link",
     "author46", "last46", "first46", "authorlink46", "author46-link",
     "author47", "last47", "first47", "authorlink47", "author47-link",
     "author48", "last48", "first48", "authorlink48", "author48-link",
     "author49", "last49", "first49", "authorlink49", "author49-link",
     "author50", "last50", "first50", "authorlink50", "author50-link",
     "author51", "last51", "first51", "authorlink51", "author51-link",
     "author52", "last52", "first52", "authorlink52", "author52-link",
     "author53", "last53", "first53", "authorlink53", "author53-link",
     "author54", "last54", "first54", "authorlink54", "author54-link",
     "author55", "last55", "first55", "authorlink55", "author55-link",
     "author56", "last56", "first56", "authorlink56", "author56-link",
     "author57", "last57", "first57", "authorlink57", "author57-link",
     "author58", "last58", "first58", "authorlink58", "author58-link",
     "author59", "last59", "first59", "authorlink59", "author59-link",
     "author60", "last60", "first60", "authorlink60", "author60-link",
     "author61", "last61", "first61", "authorlink61", "author61-link",
     "author62", "last62", "first62", "authorlink62", "author62-link",
     "author63", "last63", "first63", "authorlink63", "author63-link",
     "author64", "last64", "first64", "authorlink64", "author64-link",
     "author65", "last65", "first65", "authorlink65", "author65-link",
     "author66", "last66", "first66", "authorlink66", "author66-link",
     "author67", "last67", "first67", "authorlink67", "author67-link",
     "author68", "last68", "first68", "authorlink68", "author68-link",
     "author69", "last69", "first69", "authorlink69", "author69-link",
     "author70", "last70", "first70", "authorlink70", "author70-link",
     "author71", "last71", "first71", "authorlink71", "author71-link",
     "author72", "last72", "first72", "authorlink72", "author72-link",
     "author73", "last73", "first73", "authorlink73", "author73-link",
     "author74", "last74", "first74", "authorlink74", "author74-link",
     "author75", "last75", "first75", "authorlink75", "author75-link",
     "author76", "last76", "first76", "authorlink76", "author76-link",
     "author77", "last77", "first77", "authorlink77", "author77-link",
     "author78", "last78", "first78", "authorlink78", "author78-link",
     "author79", "last79", "first79", "authorlink79", "author79-link",
     "author80", "last80", "first80", "authorlink80", "author80-link",
     "author81", "last81", "first81", "authorlink81", "author81-link",
     "author82", "last82", "first82", "authorlink82", "author82-link",
     "author83", "last83", "first83", "authorlink83", "author83-link",
     "author84", "last84", "first84", "authorlink84", "author84-link",
     "author85", "last85", "first85", "authorlink85", "author85-link",
     "author86", "last86", "first86", "authorlink86", "author86-link",
     "author87", "last87", "first87", "authorlink87", "author87-link",
     "author88", "last88", "first88", "authorlink88", "author88-link",
     "author89", "last89", "first89", "authorlink89", "author89-link",
     "author90", "last90", "first90", "authorlink90", "author90-link",
     "author91", "last91", "first91", "authorlink91", "author91-link",
     "author92", "last92", "first92", "authorlink92", "author92-link",
     "author93", "last93", "first93", "authorlink93", "author93-link",
     "author94", "last94", "first94", "authorlink94", "author94-link",
     "author95", "last95", "first95", "authorlink95", "author95-link",
     "author96", "last96", "first96", "authorlink96", "author96-link",
     "author97", "last97", "first97", "authorlink97", "author97-link",
     "author98", "last98", "first98", "authorlink98", "author98-link",
     "author99", "last99", "first99", "authorlink99", "author99-link",
     "editor", "editor1",
     "editor-last", "editor1-last",
     "editor-first", "editor1-first",
     "editor-link", "editor1-link",
     "editor2", "editor2-author", "editor2-first", "editor2-link",
     "editor3", "editor3-author", "editor3-first", "editor3-link",
     "editor4", "editor4-author", "editor4-first", "editor4-link",
     "others",
     "chapter", "trans_chapter",  "chapterurl",
     "title", "trans_title", "language",
     "url",
     "archiveurl",
     "archivedate",
     "format",
     "accessdate",
     "edition",
     "series",
     "journal",
     "volume",
     "issue",
     "page",
     "pages",
     "nopp",
     "publisher",
     "location",
     "date",
     "origyear",
     "year",
     "month",
     "location",
     "language",
     "isbn",
     "issn",
     "oclc",
     "pmid", "pmc",
     "doi",
     "doi_brokendate", "doi_inactivedate",
     "bibcode",
     "id",
     "quote",
     "ref",
     "laysummary",
     "laydate",
     "separator",
     "postscript",
     "authorauthoramp",
   );
}

global $dontCap, $unCapped;
// Remember to enclose any word in spaces.
// $dontCap is a global array of strings that should not be capitalized in their titlecase format; $unCapped is their correct capitalization
$dontCap  = array(' and Then ', ' Of ',' The ',' And ',' An ',' Or ',' Nor ',' But ',' Is ',' If ',' Then ',' Else ',' When', 'At ',' From ',' By ',' On ',' Off ',' For ',' In ',' Over ',' To ',' Into ',' With ',' U S A ',' Usa ',' Et ');
$unCapped = array(' and then ', ' of ',' the ',' and ',' an ',' or ',' nor ',' but ',' is ',' if ',' then ',' else ',' when', 'at ',' from ',' by ',' on ',' off ',' for ',' in ',' over ',' to ',' into ',' with ',' U S A ',' USA ',' et ');

// journal acrynyms which should be capitilised are downloaded from User:Citation_bot/capitalisation_exclusions
$bot->fetch(wikiroot . "title=" . urlencode('User:Citation_bot/capitalisation_exclusions') . "&action=raw");
if (preg_match_all('~\n\*\s*(.+)~', $bot->results, $dontCaps)) {
	foreach ($dontCaps[1] as $o) {
		$unCapped[] = ' ' . trim($o) . ' ';
    // dontCap is a global array of strings that should not be capitalized in their titlecase format; $unCapped is their correct capitalization
    $dontCap[] = ' '
               . trim(
                      (strlen(str_replace(array("[", "]"), "", trim($o))) > 6)
                      ? mb_convert_case($o, MB_CASE_TITLE, "UTF-8")
                      :$o
                 )
               . ' ';
	}
}

/** Returns revision number */
function revisionID() {
    global $last_revision_id;
    if ($last_revision_id) return $last_revision_id;
    $svnid = '$Rev: 432 $';
    $scid = substr($svnid, 6);
    $thisRevId = intval(substr($scid, 0, strlen($scid) - 2));
    return expandFnsRevId() > $thisRefId ? expandFnsRevId() : $thisRevId;
    $repos_handle = svn_repos_open('~/citation-bot');
    return svn_fs_youngest_rev($repos_handle);
}

function bubble_p ($a, $b) {
  return ($a["weight"] > $b["weight"]) ? 1 : -1;
}

function is($key){
	global $p;
  return ("" != trim($p[$key][0])) ? true : false;
}

function dbg($array, $key = false) {
if(myIP())
	echo "<pre>" . str_replace("<", "&lt;", $key ? print_r(array($key=>$array),1) : print_r($array,1)), "</pre>";
else echo "<p>Debug mode active</p>";
}

function myIP() {
	switch ($_SERVER["REMOTE_ADDR"]){
		case "1":
    case "":
		case "86.6.164.132":
		case "99.232.120.132":
		case "192.75.204.31":
		return true;
		default: return false;
	}
}

/*underTwoAuthors
  * Return true if 0 or 1 author in $author; false otherwise
 */
function underTwoAuthors($author) {
  $author = str_replace(array (" '", "et al"), "", $author);
  $chars = count_chars(trim($author));
  if ($chars[ord(";")] > 0 || $chars[ord(" ")] > 2 || $chars[ord(",")] > 1) {
    return false;
  }
  return true;
}

/* jrTest - tests a name for a Junior appelation
 *  Input: $name - the name to be tested
 * Output: array ($name without Jr, if $name ends in Jr, Jr)
 */
function jrTest($name) {
  $junior = (substr($name, -3) == " Jr")?" Jr":false;
  if ($junior) {
    $name = substr($name, 0, -3);
  } else {
    $junior = (substr($name, -4) == " Jr.")?" Jr.":false;
    if ($junior) {
      $name = substr($name, 0, -4);
    }
  }
  if (substr($name, -1) == ",") {
    $name = substr($name, 0, -1);
  }
  return array($name, $junior);
}

function nothingMissing($journal){
  global $authors_missing;
  if (!(is("pages") || is("page"))
      || (preg_match('~no.+no|n/a|in press|none~', $p['pages'][0] . $p['page'][0]))) {
    return false;
  }
  return ( is($journal)
        && is("volume")
        && is("issue")
        && $noPagesMissing
        && is("title")
        && (is("date") || is("year"))
        && (is("author2") || is("author2"))
        && (!$authors_missing && (is("author") || is("author1")))
  );
}

function get_data_from_pubmed($identifier = "pmid") {
  global $p;
  echo "\n - Checking " . strtoupper($identifier) . ' ' . $p[$identifier][0] . ' for more details [DOItools.php/get_data_from_pubmed]';
  $details = pmArticleDetails($p[$identifier][0], $identifier);
  foreach ($details as $key => $value) {
    if (if_null_set($key, $value) && $key == 'pmid') {
      // PMC search is limited but will at least return a PMID.
      get_data_from_pubmed('pmid');
    } else if ($identifier == 'pmc' && $key == 'title') {
      // this will only be called with $identifier=pmc if a PMC id has just been discovered in a fragmentary citation.
      if_null_set ('title', $value); // According to a previous comment, it may sometimes be necessary to forcedly set the title in cite webs.  I've not implemented this; I'll wait to see whether it causes problems.
    }
  }
  if (false && !is("url")) { // TODO:  BUGGY - CHECK PMID DATABASES, and see other occurrence above
    if (!is('pmc')) {
     $url = pmFullTextUrl($p["pmid"][0]);
    } else {
      unset ($p['url']);
    }
    if ($url) {
      set ("url", $url);
    }
  }
}

function expand_from_crossref ($crossRef, $editing_cite_doi_template, $silence = false) {
  if ($silence) {
    ob_start();
  }
  global $p, $doiCrossRef, $jstor_redirect, $priorP;
  if (substr($p["doi"][0], 3, 4) == "2307") {
    echo "\n - Populating from JSTOR database: ";
    if (get_data_from_jstor($p["doi"][0])) {
      $crossRef = crossRefData($p["doi"][0]);
      if (!$crossRef) {
        // JSTOR's UID is not registered as a DOI, meaning that there is another (correct - DOIs should be unique) DOI, issued by the publisher.
        if ($editing_cite_doi_template) {
          $jstor_redirect = $p["doi"][0];
          }
        unset ($p["doi"][0]);
        $crossRef = crossRefDoi($p["title"][0], $p["journal"][0], is("author1")?$p["author1"][0]:$p["author"][0]
                               , $p["year"][0], $p["volume"][0], get_first_page($p), get_last_page($p), $p["issn"][0], null);
      }
    } else {
      echo "not found in JSTOR?";
    }
  } else {
    // Not a JSTOR doi, use CrossRef
    $crossRef = $crossRef?$crossRef:crossRefData(urlencode(trim($p["doi"][0])));
  }

  if ($crossRef) {
    echo "\n - Checking CrossRef for more details [DOItools.php/expand_from_crossref]";
    if ($editing_cite_doi_template) {
      $doiCrossRef = $crossRef;
    }
    if ($crossRef->volume_title && !is('journal')) {
      if_null_set("chapter", $crossRef->article_title);
      if (strtolower($p["title"][0]) == strtolower($crossRef->article_title)) {
        unset($p['title'][0]);
      }
      if_null_set('title', $crossRef->volume_title);
    } else {
      if_null_set('title', $crossRef->article_title);
    }
    if_null_set('series', $crossRef->series_title);
    if_null_set("year", $crossRef->year);
    if (!is("editor") && !is("editor1") && !is("editor-last") && !is("editor1-last")
        && $crossRef->contributors->contributor) {
      foreach ($crossRef->contributors->contributor as $author) {
        if ($author["contributor_role"] == "editor") {
          ++$ed_i;
          if ($ed_i < 5) {
            if_null_set("editor$ed_i-last", formatSurname($author->surname));
            if_null_set("editor$ed_i-first", formatForename($author->given_name));
          }
        } else {
          ++$au_i;
          if_null_set("last$au_i", formatSurname($author->surname));
          if_null_set("first$au_i", formatForename($author->given_name));
        }
      }
    }
    if_null_set("doi", $crossRef->doi);
    if_null_set("isbn", $crossRef->isbn);
    if ($jstor_redirect) {
      global $jstor_redirect_target;
      $jstor_redirect_target = $crossRef->doi;
    }
    if_null_set("journal", $crossRef->journal_title);
    if ($crossRef->volume > 0) {
      if_null_set("volume", $crossRef->volume);
    }
    if ((integer) $crossRef->issue > 1) {
    // "1" may refer to a journal without issue numbers,
    //  e.g. 10.1146/annurev.fl.23.010191.001111, as well as a genuine issue 1.  Best ignore.
      if_null_set("issue", $crossRef->issue);
    }
    if (!is("page")) if_null_set("pages", $crossRef->first_page
              . ($crossRef->last_page && ($crossRef->first_page != $crossRef->last_page)
              ? "-" . $crossRef->last_page //replaced by an endash later in script
              : "") );
    echo " (ok)";
    searchForPmid();
  } else {
    echo "\n - No CrossRef record found :-(";
  }
  if ($silence) {
    ob_end_clean();
  }
  return $crossRef;
}

// text must be text that contains  a SICI.  It could be an entire citation.
function get_data_from_sici($text) {
  if (preg_match(siciRegExp, urldecode($text), $sici)) {
    if (!is($journal) && !is("issn")) set("issn", $sici[1]);
    #if (!is ("year") && !is("month") && $sici[3]) set("month", date("M", mktime(0, 0, 0, $sici[3], 1, 2005)));
    if (!is("year")) set("year", $sici[2]);
    #if (!is("day") && is("month") && $sici[4]) set ("day", $sici[4]);
    if (!is("volume")) set("volume", 1*$sici[5]);
    if (!is("issue") && $sici[6]) set("issue", 1*$sici[6]);
    if (!is("pages") && !is("page")) set("pages", 1*$sici[7]);
    return true;
  } else return false;
}

function get_data_from_adsabs() {
  global $p;
  $url_root = "http://adsabs.harvard.edu/cgi-bin/abs_connect?data_type=XML&";
  if (is("bibcode")) {
    $xml = simplexml_load_file($url_root . "bibcode=" . urlencode($p["bibcode"][0]));
  } elseif (is("doi")) {
    $xml = simplexml_load_file($url_root . "doi=" . urlencode($p["doi"][0]));
  } elseif (is("title")) {
    $xml = simplexml_load_file($url_root . "title=" . urlencode('"' . $p["title"][0] . '"'));
    $inTitle = str_replace(array(" ", "\n", "\r"), "", (mb_strtolower($xml->record->title)));
    $dbTitle = str_replace(array(" ", "\n", "\r"), "", (mb_strtolower($p["title"][0])));
    if (
         (strlen($inTitle) > 254 || strlen(dbTitle) > 254) 
            ? strlen($inTitle) != strlen($dbTitle) || similar_text($inTitle, $dbTitle)/strlen($inTitle) < 0.98
            : levenshtein($inTitle, $dbTitle) > 3
        ) {
      echo "\n   Similar title not found in database";
      return false;
    }
  }
  if ($xml["retrieved"] != 1 && is("journal")) {
    // try partial search using bibcode components:
    $xml = simplexml_load_file($url_root
            . "year=" . $p["year"][0]
            . "&volume=" . $p["volume"][0]
            . "&page=" . ($p["pages"] ? $p["pages"][0] : $p["page"][0])
            );
    $journal_string = explode(",", (string) $xml->record->journal);
    $journal_fuzzyer = "~\bof\b|\bthe\b|\ba\beedings\b|\W~";
    if (strpos(mb_strtolower(preg_replace($journal_fuzzyer, "", $p["journal"][0])),
            mb_strtolower(preg_replace($journal_fuzzyer, "", $journal_string[0]))) === FALSE) {
      echo "\n   Match for pagination but database journal \"{$journal_string[0]}\" didn't match \"journal = {$p["journal"][0]}\".";
      return false;
    }
  }
  if ($xml["retrieved"] == 1) {
    if_null_set("bibcode", (string) $xml->record->bibcode);
    if_null_set("title", (string) $xml->record->title);
    foreach ($xml->record->author as $author) {
      if_null_set("author" . ++$i, $author);
    }
    $journal_string = explode(",", (string) $xml->record->journal);
    $journal_start = mb_strtolower($journal_string[0]);
    if_null_set("volume", (string) $xml->record->volume);
    if_null_set("issue", (string) $xml->record->issue);
    if_null_set("year", preg_replace("~\D~", "", (string) $xml->record->pubdate));
    if_null_set("pages", (string) $xml->record->page);
    if (preg_match("~\bthesis\b~ui", $journal_start)) {}
    elseif (substr($journal_start, 0, 6) == "eprint") {
      if (substr($journal_start, 7, 6) == "arxiv:") {
        if (if_null_set("arxiv", substr($journal_start, 13))) { // nothingMissing will return FALSE as no journal!
          get_data_from_arxiv(substr($journal_start, 13));
          }
      } else {
        $p["id"][0] .= " " . substr($journal_start, 13);
      }
    } else {
      if_null_set("journal", $journal_string[0]);
    }
    if (if_null_set("doi", (string) $xml->record->DOI) && nothingMissing("journal")) {
      get_data_from_doi();
    }
    return true;
  } else {
    return false;
  }
}

function expand_from_doi($a, $b, $c = false, $DEPRECATED = TRUE) {
  print "\n\n !! ==== \n\n USING DUD FN DOI! \n\n";
  expand_from_crossref($a, $b, $c);
}

function get_data_from_doi($doi, $silence) {
  global $editing_cite_doi_template;
  $crossRef = crossRefData($doi);
  if ($crossRef) 
    return expand_from_crossref($crossRef, $editing_cite_doi_template, $silence);
  else if (substr(trim($doi), 0, 8) == '10.2307/')
    return get_data_from_jstor(substr(trim($doi), 8));
  else return false;
}

function getDataFromArxiv($a, $DEPRECATED = TRUE) {
  print "\n\n !! ==== \n\n USING DUD FN ARXIV! \n\n";
  return get_data_from_arxiv($a);
}

function expand_from_pubmed($DEPRECATED = TRUE) {
  print "\n\n !! ==== \n\n USING DUD FN PMID! \n\n";
  return get_data_from_pubmed();
}

function getInfoFromISBN($DEPRECATED = TRUE) {
  print "\n\n !! ==== \n\n USING DUD FN ISBN! \n\n";
  return get_data_from_isbn($a);
}

function get_data_from_arxiv($a) {
  $xml = simplexml_load_string(
          preg_replace("~(</?)(\w+):([^>]*>)~", "$1$2$3", file_get_contents("http://export.arxiv.org/api/query?start=0&max_results=1&id_list=$a"))
          );
	if ($xml) {
		global $p;
		foreach ($xml->entry->author as $auth) {
			$i++;
      $name = $auth->name;
      if (preg_match("~(.+\.)(.+?)$~", $name, $names)) {
        if_null_set("last$i", $names[2]); // I previously had "author$i", which prevented "first$i" from being null-set
        if_null_set("first$i", $names[1]);
        // If there's a newline before the forename,, remove it so it displays alongside the surname.
        if (strpos($p["first$i"], "\n" !== false)) {
          $p["first$i"][1] = " | ";
        }
      }
      elseif (trim($p['author'][0]) == "") {
          if_null_set("author$i", $name);
      }
      
		}
    if_null_set("title", (string)$xml->entry->title);
		if_null_set("class", (string)$xml->entry->category["term"]);
		if_null_set("author", substr($authors, 2));
    if (if_null_set("doi", (string) $xml->entry->arxivdoi) && !nothingMissing("journal")) {
      get_data_from_doi((string) $xml->entry->arxivdoi);
    }
    if ($xml->entry->arxivjournal_ref) {
      $journal_data = (string) $xml->entry->arxivjournal_ref;
      if (preg_match("~(\(?([12]\d{3})\)?).*?$~", $journal_data, $match)) {
        $journal_data = str_replace($match[1], "", $journal_data);
        if_null_set("year", $match[2]);
      }
      if (preg_match("~\w?\d+-\w?\d+~", $journal_data, $match)) {
        $journal_data = str_replace($match[0], "", $journal_data);
        if_null_set("pages", str_replace("--", en_dash, $match[0]));
      }
      if (preg_match("~(\d+)(?:\D+(\d+))?~", $journal_data, $match)) {
        if_null_set("volume", $match[1]);
        if_null_set("issue", $match[2]);
        $journal_data = preg_replace("~[\s:,;]*$~", "", 
                str_replace(array($match[1], $match[2]), "", $journal_data));
      }
      if_null_set("journal", $journal_data);
    } else {
      if_null_set("year", date("Y", strtotime((string)$xml->entry->published)));
    } 
		return true;
	}
	return false;
}

function get_data_from_jstor($jid) {
  $jstor_url = "http://dfr.jstor.org/sru/?operation=searchRetrieve&query=dc.identifier%3D%22$jid%22&version=1.1";
  $data = @file_get_contents ($jstor_url);
  $xml = simplexml_load_string(str_replace(":", "___", $data));
  if ($xml->srw___numberOfRecords == 1) {
    $data = $xml->srw___records->srw___record->srw___recordData;
    global $p;
    if (trim(substr($p["doi"][0], 0, 7)) == "10.2307" || is("jstor")) {
      if (strpos($p["url"][0], "jstor.org")) {
        unset($p["url"]);
        if_null_set("jstor", substr($jid, 8));
      }
    }
    if (preg_match("~(pp\. )?(\w*\d+.*)~", $data->dc___coverage, $match)) {
      if_null_set("pages", str_replace("___", ":", $match[2]));
    }
    foreach ($data->dc___creator as $author) {
      $i++;
      $oAuthor = formatAuthor(str_replace("___", ":", $author));
      $oAuthor = explode(", ", $oAuthor);
      $first = str_replace(" .", "",
                 preg_replace("~(\w)\w*\W*((\w)\w*\W+)?((\w)\w*\W+)?((\w)\w*)?~",
                              "$1. $3. $5. $7.", $oAuthor[1]));
      if_null_set("last$i", $oAuthor[0]);
      if_null_set("first$i", $first);
    }
    if_null_set("title", (string) str_replace("___", ":", $data->dc___title)) ;
    if (preg_match("~(.*),\s+Vol\.\s+([^,]+)(, No\. (\S+))?~", str_replace("___", ":", $data->dc___relation), $match)) {
      if_null_set("journal", str_replace("___", ":", $match[1]));
      if_null_set("volume", $match[2]);
      if_null_set("issue", $match[4]);
      $handled_data = true;
    } else {
      if (preg_match("~Vol\.___\s*([\w\d]+)~", $data->dc___relation, $match)) {
        if_null_set("volume", $match[1]);
        $handled_data = true;
      }
      if (preg_match("~No\.___\s*([\w\d]+)~", $data->dc___relation, $match)) {
        if_null_set("issue", $match[1]);
        $handled_data = true;
      }
      if (preg_match("~JOURNAL___\s*([\w\d\s]+)~", $data->dc___relation, $match)) {
        if_null_set("journal", str_replace("___", ":", $match[1]));
        $handled_data = true;
      }
    }
    if (!$handled_data) {
      echo "unhandled data: $data->dc___relation";
    }
    /* -- JSTOR's publisher field is often dodgily formatted.
    if (preg_match("~[^/;]*~", $data->dc___publisher, str_replace("___", ":", $match))) {
      if_null_set("publisher", $match[0]);
    }*/
    if (preg_match ("~\d{4}~", $data->dc___date[0], $match)) {
      if_null_set("year", str_replace("___", ":", $match[0]));
    }
    return true;
  } else {
    echo $xml->srw___numberOfRecords . " records obtained. ";
    return false;
  }
}

function crossRefData($doi) {
	global $crossRefId;
  $url = "http://www.crossref.org/openurl/?pid=$crossRefId&id=doi:$doi&noredirect=true";
  $xml = @simplexml_load_file($url);
  if ($xml) {
    $result = $xml->query_result->body->query;
  } else {
     echo "Error loading CrossRef file from DOI $doi!  <br>\n";
     return false;
  }
	return ($result["status"]=="resolved")?$result:false;
}

function crossRefDoi($title, $journal, $author, $year, $volume, $startpage, $endpage, $issn, $url1, $debug = false ){
  global $priorP;
  $input = array($title, $journal, $author, $year, $volume, $startpage, $endpage, $issn, $url1);
  if ($input == $priorP['crossref']) {
    echo "\n   * Data not changed since last CrossRef search.";
    return false;
  } else {
    $priorP['crossref'] = $input;
    global $crossRefId;
    if ($journal || $issn) {
      $url = "http://www.crossref.org/openurl/?noredirect=true&pid=$crossRefId"
           . ($title ? "&atitle=" . urlencode(deWikify($title)) : "")
           . ($author ? "&aulast=" . urlencode($author) : '')
           . ($startpage ? "&spage=" . urlencode($startpage) : '')
           . ($endpage > $startpage ? "&epage=" . urlencode($endpage) : '')
           . ($year ? "&date=" . urlencode(preg_replace("~([12]\d{3}).*~", "$1", $year)) : '')
           . ($volume ? "&volume=" . urlencode($volume) : '')
           . ($issn ? "&issn=$issn" : ($journal ? "&title=" . urlencode(deWikify($journal)) : ''));
      if (!($result = @simplexml_load_file($url)->query_result->body->query)){
        echo "\n   * Error loading simpleXML file from CrossRef.";
      }
      else if ($result['status'] == 'malformed') {
        echo "\n   * Cannot search CrossRef: " . $result->msg;
      }
      else if ($result["status"] == "resolved") {
        return $result;
      }
    }
    if ($url1) {
      $url = "http://www.crossref.org/openurl/?url_ver=Z39.88-2004&req_dat=$crossRefId&rft_id=info:http://" . urlencode(str_replace(Array("http://", "&noredirect=true"), Array("", ""), urldecode($url1)));
      if (!($result = @simplexml_load_file($url)->query_result->body->query)) echo "\n xxx Error loading simpleXML file from CrossRef via URL. ";
      if ($debug) echo $url . "<BR>";
      if ($result["status"]=="resolved") return $result;
      echo "URL search failed.  Trying other parameters... ";
    }
    global $fastMode;
    if ($fastMode || !$author || !($journal || $issn) ) return;
    // If fail, try again with fewer constraints...
    echo "Full search failed. Dropping author & endpage... ";
    $url = "http://www.crossref.org/openurl/?noredirect=true&pid=$crossRefId";
    if ($title) $url .= "&atitle=" . urlencode(deWikify($title));
    if ($issn) $url .= "&issn=$issn"; elseif ($journal) $url .= "&title=" . urlencode(deWikify($journal));
    if ($year) $url .= "&date=" . urlencode($year);
    if ($volume) $url .= "&volume=" . urlencode($volume);
    if ($startpage) $url .= "&spage=" . urlencode($startpage);
    if (!($result = @simplexml_load_file($url)->query_result->body->query)) {
      echo "\n   * Error loading simpleXML file from CrossRef.";
    }
    else if ($result['status'] == 'malformed') {
      echo "\n   * Cannot search CrossRef: " . $result->msg;
    } else if ($result["status"]=="resolved") {
      echo " Successful!"; 
      return $result;
    }
  }
}

function textToSearchKey($key){
	switch (mb_strtolower($key)){
		case "doi": return "AID";
		case "author": case "author1": return "Author";
		case "author": case "author1": return "Author";
		case "issue": return "Issue";
		case "journal": return "Journal";
		case "pages": case "page": return "Pagination";
		case "date": case "year": return "Publication Date";
## Formatting: YYY/MM/DD Publication Date [DP]
		case "title": return "Title";
		case "pmid": return "PMID";
		case "volume": return "Volume";
		##Text Words [TW] ; Title/Abstract [TIAB]
	}
	return false;
}

/* pmSearch
 *
 * Searches pubmed based on terms provided in an array.
 * Provide an array of wikipedia parameters which exist in $p, and this function will construct a Pubmed seach query and
 * return the results as array (first result, # of results)
 * If $check_for_errors is true, it will return 'fasle' on errors returned by pubmed
 */
function pmSearch($p, $terms, $check_for_errors = false) {
  foreach ($terms as $term) {
    $key = textToSearchKey($term);
    if ($key && trim($p[$term][0]) != "") {
      $query .= " AND (" . str_replace("%E2%80%93", "-", urlencode($p[$term][0])) . "[$key])";
    }
  }
  $query = substr($query, 5);
  $url = "http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&tool=DOIbot&email=martins+pubmed@gmail.com&term=$query";
  $xml = simplexml_load_file($url);
  if ($check_for_errors && $xml->ErrorList) {
    echo $xml->ErrorList->PhraseNotFound
            ? " no results."
            : "\n - Errors detected in PMID search (" . print_r($xml->ErrorList, 1) . "); abandoned.";
    return array(null, 0);
  }

  return $xml?array((string)$xml->IdList->Id[0], (string)$xml->Count):array(null, 0);// first results; number of results
}

/* pmSearchResults
 *
 * Performs a search based on article data, using the DOI preferentially, and failing that, the rest of the article details.
 * Returns an array:
 *   [0] => PMID of first matching result
 *   [1] => total number of results
 *
 */
function pmSearchResults($p){
	if ($p) {
    if ($p['doi'][0]) {
      $results = pmSearch($p, array("doi"), true);
      if ($results[1] == 1) return $results;
    }
    // If we've got this far, the DOI was unproductive or there was no DOI.

    if (is("journal") && is("volume") && is("pages")) {
      $results = pmSearch($p, array("journal", "volume", "issue", "pages"));
      if ($results[1] == 1) return $results;
    }

    if (is("title") && (is("author") || is("author") || is("author1") || is("author1"))) {
      $results = pmSearch($p, array("title", "author", "author", "author1", "author1"));
      if ($results[1] == 1) return $results;
      if ($results[1] > 1) {
        $results = pmSearch($p, array("title", "author", "author", "author1", "author1", "year", "date"));
        if ($results[1] == 1) return $results;
        if ($results[1] > 1) {
          $results = pmSearch($p, array("title", "author", "author", "author1", "author1", "year", "date", "volume", "issue"));
          if ($results[1] == 1) return $results;
        }
      }
    }
  }
}

function searchForPmid() {
  global $p, $priorP;
  if ($p == $priorP['pmid']) {
    echo "\n - No changes since last PubMed search.";
    return false;
  } else {
    echo "\n - Searching PubMed... ";
    $results = (pmSearchResults($p));
    if ($results[1] == 1) {
      if_null_set('pmid', $results[0]);
      $details = pmArticleDetails($results[0]);
      echo " 1 result found; updating citation";
      foreach ($details as $key=>$value) {
        if_null_set ($key, $value);
      }
      if (!is('doi')) {
        // PMID search succeeded but didn't throw up a new DOI.  Try CrossRef again.
        echo "\n - Looking for DOI in CrossRef database with new information ... ";
        $crossRef = crossRefDoi(trim($p["title"][0]), trim($p[$journal][0]),
                                get_first_author($p), trim($p["year"][0]), trim($p["volume"][0]),
                                get_first_page($p), get_last_page($p), trim($p["issn"][0]), trim($p["url"][0]));
        if ($crossRef) {
          $p["doi"][0] = $crossRef->doi;
          echo "Match found: " . $p["doi"][0];
        } else {
          echo "no match.";
        }
      }
    } else {
      echo " nothing found.";
      if (mb_strtolower(substr($citation[$cit_i+2], 0, 8)) == "citation" && !is("journal")) {
        // Check for ISBN, but only if it's a citation.  We should not risk a false positive by searching for an ISBN for a journal article!
        echo "\n - Checking for ISBN";
        $isbnToStartWith = isset($p["isbn"]);
        if (!isset($p["isbn"][0]) && is("title")) set("isbn", findISBN( $p["title"][0], $p["author"][0] . " " . $p["last"][0] . $p["last1"][0]));
        else echo "\n  Already has an ISBN. ";
        if (!$isbnToStartWith && !$p["isbn"][0]) {
            unset($p["isbn"]);
        } else {
          // getInfoFromISBN(); // Too buggy. Disabled.
        }
      }
    }
  }
  $priorP['pmid'] = $p;
}
function pmArticleDetails($pmid, $id = "pmid"){
	$result = Array();
	$xml = simplexml_load_file("http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esummary.fcgi?tool=DOIbot&email=martins@gmail.com&db=" . (($id == "pmid")?"pubmed":"pmc") . "&id=$pmid");
  // Debugging URL : view-source:http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esummary.fcgi?db=pubmed&tool=DOIbot&email=martins@gmail.com&id=

  foreach($xml->DocSum->Item as $item) {
    if (preg_match("~10\.\d{4}/[^\s\"']*~", $item, $match)) $result["doi"] = $match[0];
		switch ($item["Name"]) {
							case "Title": $result["title"] = str_replace(array("[", "]"), "",(string) $item);
			break; 	case "PubDate": preg_match("~(\d+)\s*(\w*)~", $item, $match);
																$result["year"] = (string) $match[1];
															//	$result["month"] = (string) $match[2]; DISABLED BY EUBLIDES
			break; 	case "FullJournalName": $result["journal"] = (string) $item;
			break; 	case "Volume": $result["volume"] = (string) $item;
			break; 	case "Issue": $result["issue"] = (string) $item;
			break; 	case "Pages": $result["pages"] = (string) $item;
			break; 	case "PmId": $result["pmid"] = (string) $item;
			break; 	case "ISSN": // $result["issn"] = (string) $item; DISABLED BY EUBLIDES
			break; 	case "AuthorList":
        $i = 0;
				foreach ($item->Item as $subItem) {
          $i++;
          if (authorIsHuman((string) $subItem)) {
            $jr_test = jrTest($subItem);
            $subItem = $jr_test[0];
            $junior = $jr_test[1];
            if (preg_match("~(.*) (\w+)$~", $subItem, $names)) {
              $result["last$i"] = formatSurname($names[1]) . $junior;
              $result["first$i"] = formatForename($names[2]);
            }
          } else {
            // We probably have a committee or similar.  Just use 'author$i'.
            $result["author$i"] = (string) $subItem;
          }
        }
      break; case "LangList":
        break; // Disabled at the request of EUBULIDES
      /*
        foreach ($item->Item as $subItem) {
            if ($subItem["Name"] == "Lang" && $subItem != "English" && $subItem != "Undetermined") {
              $result ["language"] = (string) $subItem;
              if ($result['title']) {
                $result['trans_title'] = $result['title'];
                unset ($result['title']);
              }
            }
          }
			break; */case "ArticleIds":
				foreach ($item->Item as $subItem) {
					switch ($subItem["Name"]) {
						case "pubmed":
                preg_match("~\d+~", (string) $subItem, $match);
                $result["pmid"] = $match[0];
                break;
						case "pmc":
              preg_match("~\d+~", (string) $subItem, $match);
              $result["pmc"] = $match[0];
              break;
						case "doi": case "pii":
              if (preg_match("~10\.\d{4}/[^\s\"']*~", (string) $subItem, $match)) {
                $result["doi"] = $match[0];
              }
              break;
            default:
              if (preg_match("~10\.\d{4}/[^\s\"']*~", (string) $subItem, $match)) {
                $result["doi"] = $match[0];
              }
              break;
					}
				}
      break;
		}
	}
	return $result;
}

function pmExpand($p, $id){
	$details = pmArticleDetails($p[$id][0], $id);
	foreach($details as $key=>$value) $p[$key][0] = $value;
}

function pmFullTextUrl($pmid){
  $xml = simplexml_load_file("http://eutils.ncbi.nlm.nih.gov/entrez/eutils/elink.fcgi?dbfrom=pubmed&id=$pmid&cmd=llinks&tool=DOIbot&email=martins+pubmed@gmail.com");
	if ($xml) {
		foreach ($xml->LinkSet->IdUrlList->IdUrlSet->ObjUrl as $url){
			foreach ($url->Attribute as $attrib) $requiredFound = strpos($url->Attribute, "required")?true:$requiredFound;
			if (!$requiredFound) return (string) $url->Url;
		}
	}
}

function google_book_expansion() {
  global $p;
  if (is("url") && preg_match("~books\.google\.[\w\.]+/.*\bid=([\w\d\-]+)~", $p["url"][0], $gid)) {
    $url = $p["url"][0];
    if (strpos($url, "#")) {
      $url_parts = explode("#", $url);
      $url = $url_parts[0];
      $hash = "#" . $url_parts[1];
    }
    $url_parts = explode("&", str_replace("?", "&", $url));
    $url = "http://books.google.com/?id=" . $gid[1];
    foreach ($url_parts as $part) {
      $part_start = explode("=", $part);
      switch ($part_start[0]) {
        case "dq": case "pg": case "lpg": case "q": case "printsec": case "cd": case "vq":
          $url .= "&" . $part;
        // TODO: vq takes precedence over dq > q.  Only use one of the above.
        case "id":
          break; // Don't "remove redundant"
        case "as": case "useragent": case "as_brr": case "source":  case "hl":
        case "ei": case "ots": case "sig": case "source": case "lr":
        case "as_brr": case "sa": case "oi": case "ct": case "client": // List of parameters known to be safe to remove
        default:
          echo "\n - $part";
          $removed_redundant++;
      }
    }
    if ($removed_redundant > 1) { // http:// is counted as 1 parameter
      $p["url"][0] = $url . $hash;
    }
    google_book_details($gid[1]);
    return true;
  }
  return false;
}

function google_book_details ($gid) {
  $google_book_url = "http://books.google.com/books/feeds/volumes/$gid";
  $simplified_xml = str_replace(":", "___", file_get_contents($google_book_url));
  $xml = simplexml_load_string($simplified_xml);
  if ($xml->dc___title[1]) {
    if_null_set("title", str_replace("___", ":", $xml->dc___title[0] . ": " . $xml->dc___title[1]));
  } else {
    if_null_set("title", str_replace("___", ":", $xml->title));
  }
  /*  Possibly contains dud information on occasion
  if_null_set("publisher", str_replace("___", ":", $xml->dc___publisher));
    */
  foreach ($xml->dc___identifier as $ident) {
    if (preg_match("~isbn.*?([\d\-]{9}[\d\-]+)~i", (string) $ident, $match)) {
      $isbn = $match[1];
    }
  }
  if_null_set("isbn", $isbn);
  // Don't set 'pages' parameter, as this refers to the CITED pages, not the page count of the book.
  $i = null;
  if (!is("editor") && !is("editor1") && !is("editor1-last") && !is("editor-last")
          && !is("author") && !is("author1") && !is("last") && !is("last1")
          && !is("publisher")) { // Too many errors in gBook database to add to existing data.   Only add if blank.

    foreach ($xml->dc___creator as $author) {
      $i++;
      if_null_set("author$i", formatAuthor(str_replace("___", ":", $author)));
    }
  }
  if_null_set("date", $xml->dc___date);
}

function findISBN ($title, $auth = false) {
	global $isbnKey, $over_isbn_limit;
  // TODO: implement over_isbn_limit based on &results=keystats in API
  if (!$over_isbn_limit) {
    $title = trim($title); $auth = trim($auth);
    $xml = simplexml_load_file("http://isbndb.com/api/books.xml?access_key=$isbnKey&index1=combined&value1=" . urlencode($title . " " . $auth));
    if ($xml->BookList["total_results"] == 1) return (string) $xml->BookList->BookData["isbn"];
    if ($auth && $title) {
      return $xml->BookList["total_results"] > 0
              ? (string) $xml->BookList->BookData["isbn"]
              : false;
    }
  } else return false;
}

function get_data_from_isbn() {
	global $p, $isbnKey;
	$params = array("author"=>"author", "year"=>"year", "publisher"=>"publisher", "location"=>"city", "title"=>"title"/*, "oclc"=>"oclcnum"*/);
	if (is("author") || is("first") || is("author1") ||
			is("editor") || is("editor-last") || is("editor-last1") || is("editor1-last")
			|| is("author") || is("author1")) unset($params["author"]);
	if (is("publisher")) {
    unset($params["location"]);
    unset($params["publisher"]);
  }
	if (is("title")) unset ($params["title"]);
	if (is("year")||is("date")) unset ($params["year"]);
	if (is("location")) unset ($params["location"]);
	foreach ($params as $null) $missingInfo = true;
	if ($missingInfo) $xml = simplexml_load_file("http://xisbn.worldcat.org/webservices/xid/isbn/" . str_replace(array("-", " "), "", $p["isbn"][0]) . "?method=getMetadata&fl=*&format=xml");#&ai=Wikipedia_doibot");
	if ($xml["stat"] == "ok") {
		foreach ($params as $key => $value)	{
			if (preg_match("~[^\[\]<>]+~", $xml->isbn[$value], $match)) {
        if_null_set($key, $match[0]);
      }
		}
		if (substr($p["author"][0], 0, 3) == "by ") $p["author"][0] =substr( $p["author"][0], 3);
		if (preg_match("~\d+~", $p["oclc"][0], $match)) $p["oclc"][0] = $match[0];
	} else {
		$xml = simplexml_load_file("http://isbndb.com/api/books.xml?access_key=$isbnKey&index1=isbn&value1=". urlencode($p["isbn"][0]));
		if ($xml->BookList["total_results"] >0){
			$params = array("title"=>"Title", "author"=>"AuthorsText", "publisher"=>"PublisherText");
			if (is("author") || is("first") || is("author1") || is("author1")) unset($params["author"]);
			foreach ($params as $key => $value)	if (!is($key)) $p[$key][0] = niceTitle((string) $xml->BookList->BookData->$value);
		} else if ($xml->ErrorMessage) {
      echo "<p class=warning>Error: Daily limit of ISBN queries has been exceeded!</p>";
    }
		else $p["ISBN-status"][0] = "May be invalid - please double check";
	}
}

function useUnusedData()
{
	// See if we can use any of the parameters lacking equals signs:
	global $p;
  // Separate up the unused data by pipes, into "$free_data"
  $free_data = explode("|", trim($p["unused_data"][0]));

  // Empty the parameter.  We'll put back anything we don't manage to assign to a parameter.
	unset($p["unused_data"]);

  if (isset($free_data[0]))
  {
		foreach ($free_data as $dat)
    {
      // If the unused data starts with a pipe, the first dat will be blank, so there's no point in checking it.
      if ($dat)
      {
        $dat = trim($dat);

        $endnote_test = explode("\n%", "\n" . $dat);
        if ($endnote_test[1]) {
          foreach ($endnote_test as $endnote_line) {
            switch ($endnote_line[0]) {
              case "A":
                $endnote_authors++;
                $endnote_parameter = "author$endnote_authors";
                break;
              case "D":
                $endnote_parameter = "date";
                break;
              case "I":
                $endnote_parameter = "publisher";
                break;
              case "C":
                $endnote_parameter = "location";
                break;
              case "J":
                $endnote_parameter = "journal";
                break;
              case "N":
                $endnote_parameter = "issue";
                break;
              case "P":
                $endnote_parameter = "pages";
                break;
              case "T":
                $endnote_parameter = "title";
                break;
              case "U":
                $endnote_parameter = "url";
                break;
              case "V":
                $endnote_parameter = "volume";
                break;
              case "@": // ISSN / ISBN
                if (preg_match("~@\s*[\d\-]{10,}~", $endnote_line)) {
                  $endnote_parameter = "isbn";
                  break;
                } else if (preg_match("~@\s*\d{4}\-?\d{4}~", $endnote_line)) {
                  $endnote_parameter = "issn";
                  break;
                } else {
                  $endnote_parameter = false;
                }
              case "R": // Resource identifier... *may* be DOI but probably isn't always.
              case "8": // Date
              case "0":// Citation type
              case "X": // Abstract
              case "M": // Object identifier
                $dat = trim(str_replace("\n%$endnote_line", "", "\n" . $dat));
              default:
                $endnote_parameter = false;
            }
            if ($endnote_parameter && if_null_set($endnote_parameter, substr($endnote_line, 1))) {
              global $auto_summary;
              if (!strpos("Converted Endnote citation to WP format", $auto_summary)) {
                $auto_summary .= "Converted Endnote citation to WP format. ";
              }
              $dat = trim(str_replace("\n%$endnote_line", "", "\n$dat"));
            }
          }
        }
        if (preg_match("~^TY\s+-\s+[A-Z]+~", $dat)) {
          // RIS formatted data:
          $ris = explode("\n", $dat);
          foreach ($ris as $ris_line) {
            $ris_part = explode(" - ", $ris_line . " ");
            switch (trim($ris_part[0])) {
              case "T1":
              case "TI":
                $ris_parameter = "title";
                break;
              case "AU":
                $ris_authors++;
                $ris_parameter = "author$ris_authors";
                $ris_part[1] = formatAuthor($ris_part[1]);
                break;
              case "Y1":
                $ris_parameter = "date";
                break;
              case "SP":
                $start_page = trim($ris_part[1]);
                $dat = trim(str_replace("\n$ris_line", "", "\n$dat"));
                break;
              case "EP":
                $end_page = trim($ris_part[1]);
                $dat = trim(str_replace("\n$ris_line", "", "\n$dat"));
                if_null_set("pages", $start_page . "-" . $end_page);
                break;
              case "DO":
                $ris_parameter = "doi";
                break;
              case "JO":
              case "JF":
                $ris_parameter = "journal";
                break;
              case "VL":
                $ris_parameter = "volume";
                break;
              case "IS":
                $ris_parameter = "issue";
                break;
              case "SN":
                $ris_parameter = "issn";
                break;
              case "UR":
                $ris_parameter = "url";
                break;
              case "PB":
                $ris_parameter = "publisher";
                break;
              case "M3": case "PY": case "N1": case "N2": case "ER": case "TY": case "KW":
                $dat = trim(str_replace("\n$ris_line", "", "\n$dat"));
              default:
                $ris_parameter = false;
            }
            unset($ris_part[0]);
            if ($ris_parameter
                    && if_null_set($ris_parameter, trim(implode($ris_part)))
                ) {
              global $auto_summary;
              if (!strpos("Converted RIS citation to WP format", $auto_summary)) {
                $auto_summary .= "Converted RIS citation to WP format. ";
              }
              $dat = trim(str_replace("\n$ris_line", "", "\n$dat"));
            }
          }

        }
        if (preg_match_all("~(\w+)\.?[:\-\s]*([^\s;:,.]+)[;.,]*~", $dat, $match)) {
          foreach ($match[0] as $i => $oMatch) {
            switch (strtolower($match[1][$i])) {
              case "vol": case "v": case 'volume':
                $matched_parameter = "volume";
                break;
              case "no": case "number": case 'issue': case 'n':
                $matched_parameter = "issue";
                break;
              case 'pages': case 'pp': case 'pg': case 'pgs': case 'pag':
                $matched_parameter = "pages";
                break;
              case 'p':
                $matched_parameter = "page";
                break;
              default: 
                $matched_parameter = null;
            }
            if ($matched_parameter) { 
              $dat = trim(str_replace($oMatch, "", $dat));
              if_null_set($matched_parameter, $match[2][$i]);
            }
          }
        }
        if (preg_match("~(\d+)\s*(?:\((\d+)\))?\s*:\s*(\d+(?:\d\s*-\s*\d+))~", $dat, $match)) {
          if_null_set('volume', $match[1]);
          if_null_set('issue', $match[2]);
          if_null_set('pages', $match[3]);
          $dat = trim(str_replace($match[0], '', $dat));
        }
        if (preg_match("~\(?(1[89]\d\d|20\d\d)[.,;\)]*~", $dat, $match)) {
          if (if_null_set('year', $match[1])) {
            $dat = trim(str_replace($match[0], '', $dat));
          }
        }
        // Load list of parameters used in citation templates.
        //We generated this earlier in expandFns.php.  It is sorted from longest to shortest.
        global $parameter_list;

        $shortest = -1;
        foreach ($parameter_list as $parameter)
        {
          $para_len = strlen($parameter);
          if (substr(strtolower($dat), 0, $para_len) == $parameter) {
            $character_after_parameter = substr(trim(substr($dat, $para_len)), 0, 1);
            $parameter_value = ($character_after_parameter == "-" || $character_after_parameter == ":")
              ? substr(trim(substr($dat, $para_len)), 1) : substr($dat, $para_len);
            if_null_set($parameter, $parameter_value);
            break;
          }
          $test_dat = preg_replace("~\d~", "_$0",
                      preg_replace("~[ -+].*$~", "", substr(mb_strtolower($dat), 0, $para_len)));
          if ($para_len < 3)
          {
            break; // minimum length to avoid false positives
          }

          if (preg_match("~\d~", $parameter))
          {
            $lev = levenshtein($test_dat, preg_replace("~\d~", "_$0", $parameter));
            $para_len++;
          }
          else
          {
            $lev = levenshtein($test_dat, $parameter);
          }
          if ($lev == 0)
          {
            $closest = $parameter;
            $shortest = 0;
            break;
          }
          // Strict inequality as we want to favour the longest match possible
          if ($lev < $shortest || $shortest < 0)
          {
            $comp = $closest;
            $closest = $parameter;
            $shortish = $shortest;
            $shortest = $lev;
          }
          // Keep track of the second shortest result, to ensure that our chosen parameter is an out and out winner
          else if ($lev < $shortish)
          {
            $shortish = $lev;
            $comp = $parameter;
          }
        }

        if ($shortest < 3
           && (similar_text($shortest, $test_dat) / strlen($test_dat) > 0.4)
           &&  ($shortest + 1 < $shortish  // No close competitor
               || $shortest / $shortish <= 2/3
               || strlen($closest) > strlen($comp)
               )
           )
        {
            // remove leading spaces or hyphens (which may have been typoed for an equals)
            if (preg_match("~^[ -+]*(.+)~", substr($dat, strlen($closest)), $match))
            {
              set ($closest, $match[1]/* . " [$shortest / $comp = $shortish]"*/);
            }

        }
        // Is the data a URL, and is the URL parameter blank?
        else if (substr(trim($dat), 0, 7) == 'http://' && !isset($p['url']))
        {
          set ("url", $dat);
        }
        // Is it a number formatted like an ISBN?
        elseif (preg_match("~(?!<\d)(\d{10}|\d{13})(?!\d)~", str_replace(Array(" ", "-"), "", $dat), $match))
        {
          set("isbn", $match[1]);
          $pAll = "";
        }
        else
        {
          // Extract whatever appears before the first space, and compare it to common parameters
          $pAll = explode(" ", trim($dat));
          $p1 = mb_strtolower($pAll[0]);
          switch ($p1) {
          case "volume": case "vol":
          case "pages": case "page":
          case "year": case "date":
          case "title":
          case "authors": case "author":
          case "issue":
          case "journal":
          case "accessdate":
          case "archiveurl":
          case "archivedate":
          case "format":
          case "url":
          if (!is($p1)) {
            unset($pAll[0]);
            $p[$p1][0] = implode(" ", $pAll);
          }
          break;
          case "issues":
          if (!is($p1)) {
            unset($pAll[0]);
            $p['issue'][0] = implode(" ", $pAll);
          }
          break;
          case "access date":
          if (!is($p1)) {
            unset($pAll[0]);
            $p['accessdate'][0] = implode(" ", $pAll);
          }
          break;
          default:
            // No good; we'll have to return it to the unused data parameter
            $i++;
            $p["unused_data"][0] .= "|" . implode(" ", $pAll);
          }
        }
      }
		}
	}
}


// Pass $p and this function will check each parameter name against the list of accepted names (loaded in expand.php).
// It will correct any that appear to be mistyped.
function correct_parameter_spelling($p) {
  global $parameter_list;
  foreach ($p as $key => $value) {
    $parameters_used[] = $key;
  }
  $unused_parameters = array_diff($parameter_list, $parameters_used);

  // Common mistakes that aren't picked up by the levenshtein approach
  $common_mistakes = array (
                            "author1-last"  =>  "last",
                            "author2-last"  =>  "last2",
                            "author3-last"  =>  "last3",
                            "author4-last"  =>  "last4",
                            "author5-last"  =>  "last5",
                            "author6-last"  =>  "last6",
                            "author7-last"  =>  "last7",
                            "author8-last"  =>  "last8",
                            "author1-first" =>  "first",
                            "author2-first" =>  "first2",
                            "author3-first" =>  "first3",
                            "author4-first" =>  "first4",
                            "author5-first" =>  "first5",
                            "author6-first" =>  "first6",
                            "author7-first" =>  "first7",
                            "author8-first" =>  "first8",
                            "authorurl"     =>  "authorlink",
                            "authorn"       =>  "author2",
                            "authors"       =>  "author",
                            "ed"            =>  "editor",
                            "ed2"           =>  "editor2",
                            "ed3"           =>  "editor3",
                            "editorlink1"   =>  "editor1-link",
                            "editorlink2"   =>  "editor2-link",
                            "editorlink3"   =>  "editor3-link",
                            "editorlink4"   =>  "editor4-link",
                            "editor1link"   =>  "editor1-link",
                            "editor2link"   =>  "editor2-link",
                            "editor3link"   =>  "editor3-link",
                            "editor4link"   =>  "editor4-link",
                            "editorn"       =>  "editor2",
                            "editorn-link"  =>  "editor2-link",
                            "editorn-last"  =>  "editor2-last",
                            "editorn-first" =>  "editor2-first",
                            "firstn"        =>  "first2",
                            "ibsn"          =>  "isbn",
                            "lastn"         =>  "last2",
                            "number"        =>  "issue",
                            "no"            =>  "issue",
                            "No"            =>  "issue",
                            "No."           =>  "issue",
                            "origmonth"     =>  "month",
                            "pp"            =>  "pages",
                            "pp."           =>  "pages",
                            "translator"    =>  "others",
                            "translators"   =>  "others",
                            "vol"           =>  "volume",
                            "Vol"           =>  "volume",
                            "Vol."          =>  "volume",
                            );

  unset($p[""]);
  foreach ($p as $key => $value) {
    if (!in_array($key, $parameter_list))
    {
      echo "\n  *  Unrecognised parameter $key ";
      $shortest = -1;

      // Check the parameter list to find a likely replacement
      foreach ($unused_parameters as $parameter)
      {
        $lev = levenshtein($key, $parameter, 5, 4, 6);

        // Strict inequality as we want to favour the longest match possible
        if ($lev < $shortest || $shortest < 0)
        {
          $comp = $closest;
          $closest = $parameter;
          $shortish = $shortest;
          $shortest = $lev;
        }
        // Keep track of the second-shortest result, to ensure that our chosen parameter is an out and out winner
        else if ($lev < $shortish)
        {
          $shortish = $lev;
          $comp = $parameter;
        }
      }
      $key_len = strlen($key);

      // Account for short words...
      if ($key_len < 4) {
        $shortest *= ($key_len / similar_text($key, $closest));
        $shortish *= ($key_len / similar_text($key, $comp));
      }
      if ($shortest < 12 && $shortest < $shortish)
      {
        $mod[$key] = $closest;
        echo "replaced with $closest (likelihood " . (12 - $shortest) . "/12)";
      }
      else
      {
        $similarity = similar_text($key, $closest) / strlen($key);
        if ($similarity > 0.6)
        {
          $mod[$key] = $closest;
          echo "replaced with $closest (similarity " . round(12 * $similarity, 1) . "/12)";
        }
        else
        {
          echo "could not be replaced with confidence.  Please check the citation yourself.";
        }
      }
    }
  }
  // Now check for common mistakes.  This will over-ride anything found by levenshtein: important for "editor1link" !-> "editor-link".
  foreach ($common_mistakes as $mistake => $corrected) {
    if (isset($p[$mistake])) {
      $mod[$mistake] = $corrected;
    }
  }
  if ($mod) {
    foreach ($mod as $wrong => $right) {
      if (if_null_set($right, $p[$wrong][0])) {
        $p[$right] = $p[$wrong];
        unset ($p[$wrong]);
      }
    }
  }
  return $p;
}

// Check that a DOI is correctly formatted and modify it if not
function verify_doi ($doi) {
    // DOI not correctly formatted
    switch (substr($doi, -1)) {
      case ".":
        // Missing a terminal 'x'?
        $trial[] = $doi . "x";
      case ",": case ";":
        // Or is this extra punctuation copied in?
        $trial[] = substr($doi, 0, -1);
    }
    if (substr($doi, 0, 3) != "10.") {
      // missing the start
      $trial[] = $doi;
    }
    if (preg_match("~^(.+)10.\d{4}/~", trim($doi), $match)) {
      $trial[] = $match[1];
    }

    $replacements = array (
      "&lt;" => "<",
      "&gt;" => ">",
    );
    if (preg_match("~&(l|g)t;~", $doi)) {
      $trial[] = str_replace(array_keys($replacements), $replacements, $doi);
    }
    if ($trial) {
      foreach ($trial as $try) {
        // Check that it begins with 10.
        if (preg_match("~[^/]*(\d{4}/.+)$~", $try, $match)) {
          $try = "10." . $match[1];
        }
        if (crossRefData($try)) {
          set("doi", $try);
          return ($try);
        }
      }
    }
    return ($doi);
}

function file_size($url, $redirects = 0){

//Copied from WWW.
  $parsed = parse_url($url);
  $host = $parsed["host"];
  $fp = @fsockopen($host, 80, $errno, $errstr, 20);
  if(!$fp) return 9999999;
   else {
       @fputs($fp, "HEAD $url HTTP/1.1\r\n");
       @fputs($fp, "HOST: $host\r\n");
       @fputs($fp, "Connection: close\r\n\r\n");
       $headers = "";
			 $startTime = time();
       while(!@feof($fp) && strlen($headers) < 2500 && $startTime +2 > time()) $headers .= fgets ($fp, 128);
   }
   @fclose ($fp);
   $return = 999999;
   $arr_headers = explode("\n", $headers);
   foreach($arr_headers as $header) {
			// follow redirect
			$s = 'Location: ';
			if($redirects < 3 && substr(mb_strtolower ($header), 0, strlen($s)) == mb_strtolower($s)) {
				$url = trim(substr($header, strlen($s)));
				return file_size($url, $redirects + 1);
			}
			// parse for content length
       $s = "Content-Length: ";
       if(substr(mb_strtolower ($header), 0, strlen($s)) == mb_strtolower($s)) {
           $return = trim(substr($header, strlen($s)));
           break;
       }
   }
   if($return) {
			$size = round(($return / 1024) / 1024, 2);
			$return = "$size"; // in MB
   }
   return $return;
}

function deWikify($string){
	return str_replace(Array("[", "]", "'''", "''", "&"), Array("", "", "'", "'", ""), preg_replace(Array("~<[^>]*>~", "~\&[\w\d]{2,7};~", "~\[\[[^\|\]]*\|([^\]]*)\]\]~"), Array("", "", "$1"),  $string));
}

function findDoi($url){
	global $urlsTried, $slow_mode;
  // Metas might be hidden if we don't have access the the page, so try the abstract:
  $url = explode(" ", trim($url));
  $url = $url[0];
  $url = preg_replace("~\.full(\.pdf)?$~", ".abstract", $url);

	if (!@array_search($url, $urlsTried)){

		//Copied from Cite.php.  We should really use a common function?
		//Check that it's not in the URL to start with
		if (preg_match("|/(10\.\d{4}/[^?]*)|i", urldecode($url), $doi)) {echo "Found DOI in URL.<br>"; $urlsTried[] = $url;  return $doi[1];}

		//Try meta tags first.
    $meta = @get_meta_tags($url);
		if ($meta) {
			if_null_set("pmid", $meta["citation_pmid"]);
      foreach ($meta as $oTag){
				if (preg_match("~^\s*10\.\d{4}/\S*\s*~", $oTag)) {
          $doi = $oTag;
          break;
        }
			}
		}

		if (!$doi) {//If we've not scraped the DOI, we'll have to hope that it's mentioned somewhere in the text!
			if (substr($url, -4) == ".pdf") {/*
				//Check file isn't going to overload our memory
				$ch = curl_init();
				curlSetup($ch, $url);
				curl_setopt($ch, CURLOPT_HEADER, 1);
				curl_setopt($ch, CURLOPT_NOBODY, 1);
				preg_match ("~Content-Length: ([\d,]+)~", curl_exec($ch), $size);
				curl_close($ch);*/
        $size[1] = 9999999; // Takin too much memory...
			} else $size[1] = 1; // Temporary measure; return to 1!
			if (!$slow_mode) {
        echo "\n -- Aborted: not running in 'slow_mode'!";
      } else if ($size[1] > 0 &&  $size[1] < 100000) { // TODO. The bot seems to keep crashing here; let's evaluate whether it's worth doing.  For now, restrict to slow mode.
				echo "\n -- Querying URL with reported file size of ", $size[1], "b...", $htmlOutput?"<br>":"\n";
				//Initiate cURL resource
				$ch = curl_init();
				curlSetup($ch, $url);
				$source = curl_exec($ch);
				if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 404) {
          echo " -- 404 returned from URL.", $htmlOutput?"<br>":"\n";
          // Try anyway.  There may still be metas.
        } else if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 501) {
          echo " -- 501 returned from URL.", $htmlOutput?"<br>":"\n";
          return false;
        }
				curl_close($ch);
				if (strlen($source) < 100000) {
					$doi = getDoiFromText($source, true);
					if (!$doi) {
            checkTextForMetas($source);
          }
				} else {
          echo "\n -- File size was too large. Abandoned.";
        }
			} else {
        echo $htmlOutput
             ? ("\n\n ** ERROR: PDF may have been too large to open.  File size: ". $size[1]. "b<br>")
             : "\n -- PDF too large ({$size[1]}b)";
      }
		} else {
      echo " -- DOI found from meta tags.<br>";
    }
		if ($doi){
			if (!preg_match("/>\d\.\d\.\w\w;\d/", $doi))
			{ //If the DOI contains a tag but doesn't conform to the usual suntax with square brackes, it's probably picked up an HTML entity.
				echo " -- DOI may have picked up some tags. ";
				$content = strip_tags(str_replace("<", " <", $source)); // if doi is superceded by a <tag>, any ensuing text would run into it when we removed tags unless we added a space before it!
				preg_match("~" . doiRegexp . "~Ui", $content, $dois); // What comes after doi, then any nonword, but before whitespace
				if ($dois[1]) {$doi = trim($dois[1]); echo " Removing them.<br>";} else {
					echo "More probably, the DOI was itself in a tag. CHECK it's right!<br>";
					//If we can't find it when tags have been removed, it might be in a <a> tag, for example.  Use it "neat"...
				}
			}
			$urlsTried[] = $url;
			return urldecode($doi);
		} else {
			$urlsTried[] = $url;
			return false;
		}
	} else echo "URL has been scraped already - and scrapped.<br>";
	if (!$doi) $urlsTried[] = $url; //Log barren urls so we don't search them again.  We may want to search
}

function scrapeDoi($url){
	global $urlsTried, $p;
	$title = $p["title"][0];
	if (substr($url, -3) == "pdf") {
		echo "<br>PDF detected.  <small>It is too resource intensive to check that the PDF refers to the correct article.</small><br>";
	} else if (substr($url, strlen($url)-3) == "doc") {
		echo "<br>DOC detected.  <small>DOCs cannot be scraped.</small><br>";
	} else {
		if (!@array_search($url, $urlsTried)
			&& strpos($url, "www.answers.com") === FALSE
			&& strpos($url, "destinationscience") === FALSE
			&& strpos($url, "pedia/") === false
			&& strpos($url, "wiki") === false
			&& strpos($url, "pedia.") === false
			){ // Should we look at this URL? Exclude those we've already marked as barren, and those which appear to be wiki mirrors.
			set_time_limit(time_limit);
			//Initiate cURL resource
			echo " (..";
			$ch = curl_init();
			curlSetup($ch, $url);
			$source = curl_exec($ch);
			if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 404) {echo "404 returned from URL.<br>"; return false;}
			if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 501) {echo "501 returned from URL.<br>"; return false;}
			curl_close($ch);
			if (!$source) {echo "Page appears to be blank! <br>"; return false;}
			echo "..)<br>";
			if (strlen($title) < 15) {echo "Title ($title) is under 15 characters: too short to use."; return false;}
			$lSource = literate($source);
			$lTitle = literate($title);
			if (preg_match("|[=/](10\.\d{4}/[^?&]*)|", str_replace("%2F", "/", $url), $doiX)){
				//If there is a DOI in the URL
				if (preg_match("~spanclasstitle".$lTitle."~", $lSource)) {echo "DOI found in URL. Web page has correct title.<br>"; return $doiX[1];				}
				else echo "URL contains DOI, but may not refer to the correct article.<br>";
			}
			// Now check the META tags
			preg_match('~<meta name="citation_doi" content="' . doiRegexp . '">~iU', $source, $meta)?"":preg_match('~<meta name="dc.Identifier" content="' . doiRegexp . '">~iU', $source, $meta);
			if ($meta) {
				$lsTitle = literate(strip_tags($title));
				preg_match('~<meta name="citation_title" content="(.*)">~iU', $source, $metaTitle)?"":preg_match('~<meta name="dc.Title" content="(.*)">~iU', $source, $metaTitle);
				if (literate($metaTitle[1]) == $lsTitle) {echo "DOI found in meta tags: $meta[1]<br>"; return $meta[1];}
				echo "Meta info found but title does not match.<br>" . literate($metaTitle[1]) . " != <br>$lsTitle</i><br>";
			}
			//No luck? Find the DOIs in the source.
			$doi = getDoiFromText($source);
			if (!$doi) {$urlsTried[] = $url; echo "URL is barren.<br>"; return false;}
			echo "A DOI has been found. " ;
			return $doi;
		}	else {
		echo " - Cancelled. URL blacklisted.<br>";
		global $searchLimit;
		$searchLimit++;
		}
	}
	if (!$doi) {
    $urlsTried[] = $url; //Log barren urls so we don't search them again.  We may want to search
  }
}

function getDoiFromText($source, $testDoi = false){
	global $p;
	$title = $p["title"][0];
	$lSource = literate($source);
	$lTitle = literate($title);
	if (preg_match("~" . $lTitle . "~", $lSource, $titleOffset, PREG_OFFSET_CAPTURE)){

		$titleOffset = $titleOffset[1];
		//Search for anything formatted like a DOI
		if (preg_match_all("~doi.*" . doiRegexp . "~Ui", $source, $dois)){ // What comes after "doi", then any nonword, but before whitespace
			if ($dois[1][2]){
				echo "Multiple DOIs found: ";
				return false ; //We can't be sure that we've found the right one.
			} elseif (!$dois[1][1] || $dois[1][1] == $dois[1][0]) {
				//DOI is unique.  If it appears early in the document, use it.
				if ($testDoi) {$doi = testDoi(trimEnd($dois[1][0])); if ($doi) return $doi;} // DOI redirects to our URL so MUST be correct
				preg_match("~" . literate($dois[1][0]) . "~", $lSource, $thisDoi, PREG_OFFSET_CAPTURE);
				if ($thisDoi[0][1] < early){
					if (preg_match("~" . $lTitle . "~", substr($lSource, 0, early + 500))){
						//if DO I AND Title are found near the start of the article...
						echo "Unique DOI found, early in document (Offset = " . $thisDoi[0][1] . "). $doi<br>";
						return $dois[1][0];
					} else {echo "A unique DOI found early in document (Offset = " . $thisDoi[0][1] . "), but without the required title.<br>"; return false;}
				} else {
					echo "A unique DOI was found, but late in the document (offset = {$thisDoi[0][1]}). Removing HTML to get a clearer picture...<br>";
					$position = strpos(strip_tags($source), $dois[1][0]);
					if ($position < (early/2)) {
						echo "Nice and early: $position . Accepting DOI.<br>"; return $dois[1][0];
					} else{
						echo "Still too late ($position).  Rejecting."; return false;
					}
				}
			} else {echo "\n2 different DOIs were found. Abandoned.<br>"; return false;}
		} else {echo "\nNo DOIs found in page."; $urlsTried[] = $url; RETURN false;}
	}
	echo "Searched body text.<br>";
}

function checkTextForMetas($text){
  // Find all meta tags using preg_match
	preg_match_all("~<meta\s+name=['\"]([^'\"]+)['\"]\s+content=[\"']([^>]+)[\"']\s*/?>~", $text, $match);
	preg_match_all("~<meta\s+content=[\"']([^>]+)[\"']\s+name=['\"]([^'\"]+)['\"]\s*/?>~", $text, $match2);
  $matched_names = array_merge($match[1], $match2[2]);
  $matched_content = array_merge($match[2], $match2[1]);
  // Define translation from meta tag names to wiki parameters
	$m2p = array(
						"citation_journal_title" => "journal",
            "citation_title"  => "title",
            "citation_date"  => "date",
            "citation_volume"  => "volume",
            "citation_issue" => "issue",
            "citation_firstpage"  => "pages",
            "dc.Contributor" => "author",
            "dc.Title" => "title",
            "dc.Date" => "date"
	);

  // Transform matches into an array:  pairs (meta name => value)
	$stopI = count($matched_content);
	for ($i = 0; $i < $stopI; $i++) {
     $pairs[] = array($matched_names[$i], $matched_content[$i]);
  }

  // Rename each pair to $newp  (wiki name => value)
	foreach ($pairs as $pair) {
    $i = 1;
		foreach ($m2p as $metaKey => $metaValue) {
			if (mb_strtolower($pair[0]) == mb_strtolower($metaKey)) {
        if ($metaValue == "author") {
          $metaValue = "author" . $i++;
        }
        if_null_set($metaValue, $pair[1]);
      }
    }
  }

  // Now $newp contains the wiki name and the meta tag's value.  We may have multiple values, especially for the author field.
  // We only want to fiddle with authors if there are none specified.
	if (!is('author') && !is('author1') && !is('author') && !is('author1')) {
    foreach ($newp['author'] as $auth) {
      $author_list .= "$auth;";
    }
    $authors = formatAuthors($author_list, true);
    foreach ($authors as $no => $auth) {
      $names = explode (', ', $auth);
      $newp["author" . ($no + 1)] = $names[0];
      $newp["first" . ($no + 1)] = $names[1];
    }
  }
	if (isset($newp["date"])) {
		$newp["year"][0] = date("Y", strtotime($newp["date"][0]));
		//$newp["month"][0] = date("M", strtotime($newp["date"][0])); DISABLED BY EUBLIDES
		unset($newp["date"]);
	}
	foreach ($newp as $p => $p0) if_null_set($p, $p0[0]);
}

function literate($string){
	//remove all html, spaces and &eacute; things  from text, only leaving letters and digits
	preg_match_all("~(&[\w\d]*;)?(\w+)~", $string, $letters);
		foreach ($letters[2] as $letter) $return .= $letter;
	return mb_strtolower($return);
}


// The following functions "tidy" parameters.
function trimEnd($doi){
	switch (substr($doi, strlen($doi)-1)){
		case ":": case ";": case ")": case ".":	case "'": case ",":case "-":case "#":
		$doi = substr($doi, 0, strlen($doi)-1);
		$doi = trimEnd($doi); //Recursive in case more than one punctuation mark on the end
	}
	return str_replace ("\\", "", $doi);
}

function truncatePublisher($p){
	return preg_replace("~\s+(group|inc|ltd|publishing)\.?\s*$~i", "", $p);
}

/** Returns a properly capitalsied title.
 *  	If sents is true (or there is an abundance of periods), it assumes it is dealing with a title made up of sentences, and capitalises the letter after any period.
  *		If not, it will assume it is a journal abbreviation and won't capitalise after periods.
 */

function niceTitle($in, $sents = true) {
	global $dontCap, $unCapped;
	if ($in == mb_strtoupper($in) && mb_strlen(str_replace(array("[", "]"), "", trim($in))) > 6) {
		$in = mb_convert_case($in, MB_CASE_TITLE, "UTF-8");
	}
  $in = str_ireplace(" (New York, N.Y.)", "", $in); // Pubmed likes to include this after "Science", for some reason
  $captIn = str_replace($dontCap, $unCapped, " " .  $in . " ");
	if ($sents || (substr_count($in, '.') / strlen($in)) > .07) { // If there are lots of periods, then they probably mark abbrev.s, not sentance ends
    $newcase = preg_replace("~(\w\s+)A(\s+\w)~u", "$1a$2",
					preg_replace_callback("~\w{2}'[A-Z]\b~u" /*Apostrophes*/, create_function(
	            '$matches',
	            'return mb_strtolower($matches[0]);'
	        ), preg_replace_callback("~[?.:!]\s+[a-z]~u" /*Capitalise after punctuation*/, create_function(
	            '$matches',
	            'return mb_strtoupper($matches[0]);'
	        ), trim($captIn))));
	} else {
		$newcase = preg_replace("~(\w\s+)A(\s+\w)~u", "$1a$2",
					preg_replace_callback("~\w{2}'[A-Z]\b~u" /*Apostrophes*/, create_function(
	            '$matches',
	            'return mb_strtolower($matches[0]);'
	        ), trim(($captIn))));
	}
  $newcase = preg_replace_callback("~(?:'')?(?P<taxon>\p{L}+\s+\p{L}+)(?:'')?\s+(?P<nova>(?:(?:gen\.? no?v?|sp\.? no?v?|no?v?\.? sp|no?v?\.? gen)\b[\.,\s]*)+)~ui", create_function('$matches',
          'return "\'\'" . ucfirst(strtolower($matches[\'taxon\'])) . "\'\' " . strtolower($matches["nova"]);'), $newcase);
  // Use 'straight quotes' per WP:MOS
  $newcase = straighten_quotes($newcase);
  if (in_array(" " . trim($newcase) . " ", $unCapped)) {
    // Keep "z/Journal" with lcfirst
    return $newcase;
  } else {
    // Catch "the Journal" --> "The Journal"
    $newcase = mb_convert_case(mb_substr($newcase, 0, 1), MB_CASE_TITLE, "UTF-8") . mb_substr($newcase, 1);
     return $newcase;
  }
}

/** If crossRef has only sent us one author, perhaps we can find their surname in association with other authors on the URL
 *   Send the URL and the first author's SURNAME ONLY as $a1
 *  The function will return an array of authors in the form $return['authors'][3] = Author, The Third
 */
function findMoreAuthors($doi, $a1, $pages) {

  // If $pages is already interrupted by a non-digit, then it probably represents a range, so we can return it as is.
  if (preg_match("~\d\D+\d", $pages)) {
    $return['pages'] = $pages;
  }

  $stopRegexp = "[\n\(:]|\bAff"; // Not used currently - aff may not be necessary.
	$url = "http://dx.doi.org/$doi";
	echo "\n -*Looking for more authors @ $url:";
  echo "\n  - Using meta tags...";

  $meta_tags = get_meta_tags($url);
  if ($meta_tags["citation_authors"]) {
    $return['authors'] = formatAuthors($meta_tags["citation_authors"], true);
  }
  if (!$return['pages'] && !$return['authors']) {
    echo "\n  - Now scraping web-page.";
    //Initiate cURL resource
    $ch = curl_init();
    curlSetup($ch, $url);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 7);  //This means we can't get stuck.
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 404) {echo "404 returned from URL.<br>"; return false;}
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 501) {echo "501 returned from URL.<br>"; return false;}
    $source = str_ireplace(
                array('&nbsp;', '<p ',          '<DIV '),
                array(' ',     "\r\n    <p ", "\r\n    <DIV "),
                curl_exec($ch)
               ); // Spaces before '<p ' fix cases like 'Title' <p>authors</p> - otherwise 'Title' gets picked up as an author's initial.
    $source = preg_replace(
                "~<sup>.*</sup>~U",
                "",
                str_replace("\n", "\n  ", $source)
              );
    curl_close($ch);
    if (strlen($source)<1280000) {

      // Pages - only check if we don't already have a range
      if (!$return['pages'] && preg_match("~^[\d\w]+$~", trim($pages), $page)) {
        // find an end page number first
        $firstPageForm = preg_replace('~d\?([^?]*)$~U', "d$1", preg_replace('~\d~', '\d?', preg_replace('~[a-z]~i', '[a-zA-Z]?', $page[0])));
        echo "\n Searching for page number with form $firstPageForm:";
        if (preg_match("~{$page[0]}\D{0,13}?($firstPageForm)~", trim($source), $pages)) { // 13 leaves enough to catch &nbsp;
          $return['pages'] = $page[0] . '-' . $pages[1];
          echo "found range $page[0] to $pages[1]";
        } else echo "not found.";
      }

      // Authors
      if (true || !$return['authors']) {
        // Check dc.contributor, which isn't correctly handled by get_meta_tags
        if (preg_match_all("~\<meta name=\"dc.Contributor\" +content=\"([^\"]+)\"\>~U", $source, $authors)){
          $return['authors']=$authors[1];
        } else {
          echo "\nNo author specified";
        }
      }
    } else echo "\nFile size was too large. Abandoned.";
  }
	return $return;
}

function formatSurname($surname) {
  $surname = mb_convert_case(trim(mb_ereg_replace("-", " - ", $surname)), MB_CASE_LOWER);
  if (mb_substr($surname, 0, 2) == "o'") return "O'" . fmtSurname2(mb_substr($surname, 2));
	else if (mb_substr($surname, 0, 2) == "mc") return "Mc" . fmtSurname2(mb_substr($surname, 2));
	else if (mb_substr($surname, 0, 3) == "mac" && strlen($surname) > 5 && !mb_strpos($surname, "-") && mb_substr($surname, 3, 1) != "h") return "Mac" . fmtSurname2(mb_substr($surname, 3));
	else if (mb_substr($surname, 0, 1) == "&") return "&" . fmtSurname2(mb_substr($surname, 1));
	else return fmtSurname2($surname); // Case of surname
}

function fmtSurname2($surname) {
  return preg_replace_callback("~(\p{L})(\p{L}+)~u", 
          create_function('$matches',
                  'return mb_strtoupper($matches[1]) . mb_strtolower($matches[2]);'
          ),
          mb_ereg_replace(" - ", "-", $surname));
}

function formatForename($forename){
  return str_replace(array(" ."), "", trim(preg_replace_callback("~(\p{L})(\p{L}{3,})~u",  create_function(
            '$matches',
            'return mb_strtoupper($matches[1]) . mb_strtolower($matches[2]);'
        ), $forename)));
}

/* formatInitials
 *
 * Returns a string of initals, formatted for Cite Doi output
 *
 * $str: A series of initials, in any format.  NOTE! Do not pass a forename here!
 *
 */
function formatInitials($str){
	$str = trim($str);
	if ($str == "") return false;
	if (substr($str, strlen($str)-1) == ";") $end = ";";
	preg_match_all("~\w~", $str, $match);
	return mb_strtoupper(implode(".",$match[0]) . ".") . $end;
}
function isInitials($str){
	if (!$str) return false;
	if (strlen(str_replace(array("-", ".", ";"), "", $str)) >3) return false;
	if (strlen(str_replace(array("-", ".", ";"), "", $str)) ==1) return true;
	if (mb_strtoupper($str) != $str) return false;
	return true;
}

// Runs some tests to see if the full  name of a single author is unlikely to be the name of a person.
function authorIsHuman($author) {
  $author = trim($author);
  $chars = count_chars($author);
  if ($chars[ord(":")] > 0 || $chars[ord(" ")] > 3 || strlen($author) > 33) {
    return false;
  }
  return true;
}

// Returns the author's name formated as Surname, F.I.
function formatAuthor($author){

	// Requires an author who is formatted as SURNAME, FORENAME or SURNAME FORENAME or FORENAME SURNAME. Substitute initials for forenames if nec.

	$author = preg_replace("~(^[;,.\s]+|[;,.\s]+$)~", "", trim($author)); //Housekeeping
  $author = preg_replace("~^[aA]nd ~", "", trim($author)); // Just in case it has been split from a Smith; Jones; and Western
	if ($author == "") {
      return false;
  }

	#dbg($author, "formatAuthor");

	$auth = explode(",", $author);
	if ($auth[1]){
		/* Possibilities:
		Smith, A. B.
		*/
		$surname = $auth[0];
		$fore = $auth[1];
	}
	//Otherwise we've got no handy comma to separate; we'll have to use spaces and periods.
	else {
		$auth = explode(".", $author);
		if (isset($auth[1])){
			/* Possibilities are:
			M.A. Smith
			Smith M.A.
			Smith MA.
			Martin A. Smith
			MA Smith.
			Martin Smith.
			*/
			$countAuth = count($auth);
			if (!$auth[$countAuth-1]) {
				$i = array();
				// it ends in a .
				if (isInitials($auth[$countAuth-1])) {
					// it's Conway Morris S.C.
					foreach (explode(" ", $auth[0]) as $bit){
						if (isInitials($bit)) $i[] = formatInitials($bit); else $surname .= "$bit ";
					}
					unset($auth[0]);
					foreach ($auth as $bit){
						if (isInitials($bit)) $i[] = formatInitials($bit);
					}
				} else {
					foreach ($auth as $A){
						if (isInitials($A)) $i[] = formatInitials($A);
					}
				}
				$fore = mb_strtoupper(implode(".", $i));
			} else {
				// it ends with the surname
				$surname = $auth[$countAuth-1];
				unset($auth[$countAuth-1]);
				$fore = implode(".", $auth);
			}
		} else {
			// We have no punctuation! Let's delimit with spaces.
			$chunks = array_reverse(explode(" ", $author));
			$i = array();
			foreach ($chunks as $chunk){
				if (!$surname && !isInitials($chunk)) $surname = $chunk;
				else array_unshift($i, isInitials($chunk)?formatInitials($chunk):$chunk);
			}
			$fore = implode(" ", $i);
		}
	}
	return formatSurname($surname) . ", " . formatForename($fore);
}

function formatAuthors($authors, $returnAsArray = false){
	$authors = html_entity_decode($authors, null, "UTF-8");

	$return = array();
	## Split the citation into an author by author account
	$authors = preg_replace(array("~\band\b~i", "~[\d\+\*]+~"), ";", $authors); //Remove "and" and affiliation symbols

	$authors = str_replace(array("&nbsp;", "(", ")"), array(" "), $authors); //Remove spaces and weird puntcuation
	$authors = str_replace(array(".,", "&", "  "), ";", $authors); //Remove "and"
	if (preg_match("~[,;]$~", trim($authors))) $authors = substr(trim($authors), 0, strlen(trim($authors))-1); // remove trailing punctuation

	$authors = trim($authors);
	if ($authors == "") {
    return false;
  }

	$authors = explode(";", $authors);
	dbg(array("IN"=>$authors));
	if (isset($authors[1])) {
		foreach ($authors as $A){
			if (trim($A) != "")	$return[] = formatAuthor($A);
		}
	} else {
		//Use commas as delimiters
		$chunks = explode(",", $authors[0]);
		foreach ($chunks as $chunk){
			$bits = explode(" ", $chunk);
			foreach ($bits as $bit){
				if ($bit) $bitts[] = $bit;
			}
			$bits = $bitts; unset($bitts);
			#dbg($bits, '$BITS');
			if ($bits[1] || $savedChunk) {
				$return[] = formatAuthor($savedChunk .  ($savedChunk?", ":"") . $chunk);
				$savedChunk = null;
			} else $savedChunk = $chunk;// could be first author, or an author with no initials, or a surname with initials to follow.
		}
	}
	if ($savedChunk) $return[0] = $bits[0];
	$return = implode("; ", $return);
	$frags = explode(" ", $return);
	$return = array();
	foreach ($frags as $frag){
		$return[] = isInitials($frag)?formatInitials($frag):$frag;
	}
		$returnString = preg_replace("~;$~", "", trim(implode(" ", $return)));
	if ($returnAsArray){
		$authors = explode ( "; ", $returnString);
		return $authors;
	} else {
		return $returnString;
	}
}

function formatTitle($title) {
	$title = html_entity_decode($title, null, "UTF-8");
  $title = (mb_substr($title, -1) == ".")
            ? mb_substr($title, 0, -1)
            :(
              (mb_substr($title, -6) == "&nbsp;")
              ? mb_substr($title, 0, -6)
              : $title
            );
  $iIn = array("<i>","</i>", 
							"From the Cover: ");
	$iOut = array("''","''",
								"");
	$in = array("&lt;", "&gt;"	);
	$out = array("<",		">"			);
  return str_ireplace($iIn, $iOut, str_ireplace($in, $out, niceTitle($title))); // order IS important!
}

function straighten_quotes($str) {
  $str = preg_replace('~&#821[679];|[\x{2039}\x{203A}\x{2018}-\x{201B}`]|&[rl]s?[ab]?quo;~u', "'", $str);
  $str = preg_replace('~&#822[013];|[\x{00AB}\x{00BB}\x{201C}-\x{201F}]|&[rlb][ad]?quo;~u', '"', $str);
  return $str;
}

/** Format authors according to author = Surname; first= N.E.
 * Requires the global $p
**/
function citeDoiOutputFormat() {
  global $p;
  unset ($p['']);

  // Check that DOI hasn't been urlencoded.  Note that the doix parameter is decoded and used in step 1.
  if (strpos($p['doi'][0], ".2F~") && !strpos($p['doi'][0], "/")) {
    $p['doi'][0] = str_replace($dotEncode, $dotDecode, $p['doi'][0]);
  }

  // Cycle through authors
  for ($i = null; $i < 100; $i++) {
    if (strpos($p["author$i"][0], ', ')) {
      // $au is an array with two parameters: the surname [0] and forename [1].
      $au = explode(', ', $p["author$i"][0]);
      unset($p["author$i"]);
      set("author$i", formatSurname($au[0])); // i.e. drop the forename; this is safe in $au[1]
    } else if (is("first$i")) {
      $au[1] = $p["first$i"][0];
    } else {
       unset($au);
    }
    if ($au[1]) {
      if ($au[1] == mb_strtoupper($au[1]) && mb_strlen($au[1]) < 4) {
        // Try to separate Smith, LE for Smith, Le.
        $au[1] = preg_replace("~([A-Z])[\s\.]*~u", "$1.", $au[1]);
      }
      if (trim(mb_strtoupper(preg_replace("~(\w)[a-z]*.? ?~u", "$1. ", trim($au[1]))))
              != trim($p["first$i"][0])) {
        // Don't try to modify if we don't need to change
        set("first$i", mb_strtoupper(preg_replace("~(\w)[a-z]*.? ?~u", "$1. ", trim($au[1])))); // Replace names with initials; beware hyphenated names!
      }
      if (strpos($p["first$i"][1], "\n") !== false || (!$p["first$i"][1] && $p["first$i"][0])) {
        $p["first$i"][1] = " | "; // We don't want a new line for first names, it takes up too much space
      }
      if (is("author$i")) {
        $p["author$i"][1] = "\n| "; // hard-coding first$i will change the default for author$i.
      }
    }
  }
  if ($p['pages'][0]) {
    // Format pages to R100-R102 format
    if (preg_match("~([A-Za-z0-9]+)[^A-Za-z0-9]+([A-Za-z0-9]+)~", $p['pages'][0], $pp)) {
       if (strlen($pp[1]) > strlen($pp[2])) {
          // The end page range must be truncated
          $p['pages'][0] = str_replace("!!!DELETE!!!", "", preg_replace("~([A-Za-z0-9]+[^A-Za-z0-9]+)[A-Za-z0-9]+~",
                                        ("$1!!!DELETE!!!"
                                        . substr($pp[1], 0, strlen($pp[1]) - strlen($pp[2]))
                                        . $pp[2]), $p['pages'][0]));
       }
    }
  }
  //uksort($p, parameterOrder);
}

function curlSetUp($ch, $url){
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  //This means we can get stuck.
	curl_setopt($ch, CURLOPT_MAXREDIRS, 5);  //This means we can't get stuck.
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
}

function get_all_meta_tags($url){
	if (preg_match("~http://www\.pubmedcentral\.nih\.gov/articlerender\.fcgi\?artinstid=(\d*)~", $url, $pmc)) $return["pmc"]=$pmc[1];
	$ch = curl_init();
	curlSetUp($ch, $url);
	curl_setopt($ch, CURLOPT_HEADER,true);
	$pageText = curl_exec($ch);
	preg_match_all("~<meta name=\"dc\.Creator\" content=\"([^\"]*)\"~", $pageText, $creators);
	preg_match("~<meta name=['\"]citation_pmid[\"'] content=['\"](\d+)['\"]~", $pageText, $pmid);
	if ($creators[1][1]){
		foreach ($creators[1] as $aut){
			if (mb_strtoupper($aut) == $aut) {
				$return["author"] .= " " . ucwords(str_replace(",", ", ", mb_strtolower($aut))) . ";";
			} else {
				$aut = preg_split("~([A-Z])~", $aut, null,PREG_SPLIT_DELIM_CAPTURE);
				$count = count($aut);
				for ($i = 0; $i <= $count; $i+=2) $return["author"] .= $aut[$i] . (isset($aut[$i+1])?" ":"") . $aut[$i+1];
				$return["author"] .= ";";
			}
		}
		$return["author"] = str_replace(array(",;", " and;", " and ", " ;", "  ", "+", "*"), array(";", ";", " ", ";", " ", "", ""), trim(substr($return["author"], 0, strlen($return["author"])-1)));
	}
	if (isset($pmid[1])) $return["pmid"] = $pmid[1];
	curl_close($ch);
	return $return;
}

function equivUrl ($u){
	$db = preg_replace("~;jsessionid=[A-Z0-9]*~", "", str_replace("%2F", "/", str_replace("?journalCode=pdi", "",
	str_replace("sci;", "", str_replace("/full?cookieSet=1", "", str_replace("scienceonline", "sciencemag", str_replace("/fulltext/", "/abstract/",
	str_replace("/links/doi/", "/doi/abs/", str_replace("/citation/", "/abstract/", str_replace("/extract/", "/abstract/", $u))))))))));
	if (preg_match("~(.*&doi=.*)&~Ui", $db, $db2)) $db = $db2[1];
	return $db;
}

function assessUrl($url){
  echo "assessing URL ";
	#if (strpos($url, "abstract") >0 || (strpos($url, "/abs") >0 && strpos($url, "adsabs.") === false)) return "abstract page";
	$ch = curl_init();
	curlSetUp($ch, str_replace("&amp;", "&", $url));
	curl_setopt($ch, CURLOPT_NOBODY, 1);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_exec($ch);
	switch(curl_getinfo($ch, CURLINFO_HTTP_CODE)){
		case "404":
			global $p;
			return "{{dead link|date=" . date("F Y") . "}}";
		#case "403": case "401": return "subscription required"; DOesn't work for, e.g. http://arxiv.org/abs/cond-mat/9909293
	}
	curl_close($ch);
	return null;
}

function testDoi($doi) {
	global $p;
	echo "<div style='font-size:small; color:#888'>[";
	if ($p["url"][0]){
	if (strpos($p["url"][0], "ttp://dx.doi.org/")==1) return $doi;
	$ch = curl_init();
	curlSetup($ch, "http://dx.doi.org/$doi");
	curl_setopt($ch, CURLOPT_NOBODY, 1);
	$source = curl_exec($ch);
	$effectiveUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
	curl_close($ch);
	echo equivUrl($effectiveUrl), "] DOI resolves to equivalent of this.<br>",
	"[", equivUrl($p["url"][0]),"] URL was equivalent to this.</div>";
	if (equivUrl($effectiveUrl) == equivUrl($p["url"][0]))  return $doi; else return false;
	}
	echo "No URL specified]</div>";
	return false;
}

function parameterOrder($first, $author) {
  $order = list_parameters();
  $first_pos = array_search($first, $order);
  $author_pos = array_search($author, $order);
  if ($first_pos && $author_pos) {
     return array_search($first, $order) - array_search($author, $order);
  }
  else return true;
}
?>