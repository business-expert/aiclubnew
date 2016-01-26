<?php

/*

   EXAMPLE:

   include($_SERVER["DOCUMENT_ROOT"] . "/classes/paging.class.php");
   $paging = new paging();
   $paging->TotalResults = 500; //This is how many results to page through.
                                //mysql_num_rows($query) would just fine!
   print_p($paging->InfoArray());

*/

class paging 
{
   /* These are defaults */
   var $TotalResults;
   var $CurrentPage 	= 1;
   var $PageVarName 	= "page";
   var $ResultsPerPage 	= 20;
   var $LinksPerPage 	= 10;

	function __construct($TotalResults, $currentPage)
	{
	   $this->TotalResults 	=	$TotalResults;
	   $this->ResultsPerPage= 	RECORD_PER_PAGE;
	   $this->LinksPerPage 	= 	PER_PAGE_LINK;
	   $this->PageVarName 	= 	PAGE_VAR_NAME;
	   $this->CurrentPage	=	$currentPage;
	}
	
   function InfoArray() 
   {
      $this->TotalPages  = $this->getTotalPages();
      $this->CurrentPage = $this->getCurrentPage();
      $this->ResultArray = array(
								   "PREV_PAGE"    => $this->getPrevPage(),
								   "NEXT_PAGE"    => $this->getNextPage(),
								   "CURRENT_PAGE" => $this->CurrentPage,
								   "TOTAL_PAGES"  => $this->TotalPages,
								   "TOTAL_RESULTS"=> $this->TotalResults,
								   "PAGE_NUMBERS" => $this->getNumbers(),
								   "MYSQL_LIMIT1" => $this->getStartOffset(),
								   "MYSQL_LIMIT2" => $this->ResultsPerPage,
								   "START_OFFSET" => $this->getStartOffset(),
								   "END_OFFSET"   => $this->getEndOffset(),
								   "RESULTS_PER_PAGE" => $this->ResultsPerPage,
                           		);
      return $this->ResultArray;
   }

   /* Start information functions */
   function getTotalPages() {
      /* Make sure we don't devide by zero */
      if($this->TotalResults != 0 && $this->ResultsPerPage != 0) {
         $result = ceil($this->TotalResults / $this->ResultsPerPage);
      }
      /* If 0, make it 1 page */
      if(isset($result) && $result == 0) {
         return 1;
      } else {
         return $result;
      }
   }

   function getStartOffset() {
      $offset = $this->ResultsPerPage * ($this->CurrentPage - 1);
      if($offset != 0) { $offset++; }
      return $offset;
   }

   function getEndOffset() {
      if($this->getStartOffset() > ($this->TotalResults - $this->ResultsPerPage)) {
         $offset = $this->TotalResults;
      } elseif($this->getStartOffset() != 0) {
         $offset = $this->getStartOffset() + $this->ResultsPerPage - 1;
      } else {
         $offset = $this->ResultsPerPage;
      }
      return $offset;
   }

   function getCurrentPage() {
      if(isset($_GET[$this->PageVarName])) {
         return $_GET[$this->PageVarName];
      } else {
         return $this->CurrentPage;
      }
   }

   function getPrevPage() {
      if($this->CurrentPage > 1) {
         return $this->CurrentPage - 1;
      } else {
         return false;
      }
   }

   function getNextPage() {
      if($this->CurrentPage < $this->TotalPages) {
         return $this->CurrentPage + 1;
      } else {
         return false;
      }
   }

   function getStartNumber() {
      $links_per_page_half = $this->LinksPerPage / 2;
      /* See if curpage is less than half links per page */
      if($this->CurrentPage <= $links_per_page_half || $this->TotalPages <= $this->LinksPerPage) {
         return 1;
      /* See if curpage is greater than TotalPages minus Half links per page */
      } elseif($this->CurrentPage >= ($this->TotalPages - $links_per_page_half)) {
         return $this->TotalPages - $this->LinksPerPage + 1;
      } else {
         return $this->CurrentPage - $links_per_page_half;
      }
   }

   function getEndNumber() {
      if($this->TotalPages < $this->LinksPerPage) {
         return $this->TotalPages;
      } else {
         return $this->getStartNumber() + $this->LinksPerPage - 1;
      }
   }

   function getNumbers() {
      for($i=$this->getStartNumber(); $i<=$this->getEndNumber(); $i++) {
         $numbers[] = $i;
      }
      return $numbers;
   }
   
   function displayPaging()
   {
	    /* Get our array of valuable paging information! */
	   $InfoArray = $this->InfoArray();
   
	   /* Everything below here are just examples! */
	
	   /* Print our some info like "Displaying page 1 of 49" */
	   echo "Displaying page " . $InfoArray["CURRENT_PAGE"] . " of " . $InfoArray["TOTAL_PAGES"] . "<BR>";
	   echo "Displaying results " . $InfoArray["START_OFFSET"] . " - " . $InfoArray["END_OFFSET"] . " of " . $InfoArray["TOTAL_RESULTS"] . "<BR>";
	
	   /* Print our first link */
	   if($InfoArray["CURRENT_PAGE"]!= 1) {
		  echo "<a href='?page=1'>&lt;&lt;</a> ";
	   } else {
		  echo "&lt;&lt; ";
	   }
	
	   /* Print out our prev link */
	   if($InfoArray["PREV_PAGE"]) {
		  echo "<a href='?page=" . $InfoArray["PREV_PAGE"] . "'>Previous</a> | ";
	   } else {
		  echo "Previous | ";
	   }
	
	   /* Example of how to print our number links! */
	   for($i=0; $i<count($InfoArray["PAGE_NUMBERS"]); $i++) {
		  if($InfoArray["CURRENT_PAGE"] == $InfoArray["PAGE_NUMBERS"][$i]) {
			 echo $InfoArray["PAGE_NUMBERS"][$i] . " | ";
		  } else {
			 echo "<a href='?page=" . $InfoArray["PAGE_NUMBERS"][$i] . "'>" . $InfoArray["PAGE_NUMBERS"][$i] . "</a> | ";
		  }
	   }
	
	   /* Print out our next link */
	   if($InfoArray["NEXT_PAGE"]) {
		  echo " <a href='?page=" . $InfoArray["NEXT_PAGE"] . "'>Next</a>";
	   } else {
		  echo " Next";
	   }
	
	   /* Print our last link */
	   if($InfoArray["CURRENT_PAGE"]!= $InfoArray["TOTAL_PAGES"]) {
		  echo " <a href='?page=" . $InfoArray["TOTAL_PAGES"] . "'>>></a>";
	   } else {
		  echo " &gt;&gt;";
	   }
	}
	
   function displayPagingGrid()
   {
	    /* Get our array of valuable paging information! */
	   $InfoArray = $this->InfoArray();
   	
		if($InfoArray["TOTAL_RESULTS"] <= RECORD_PER_PAGE)
			return null;
	   /* Everything below here are just examples! */
	
	   /* Print our some info like "Displaying page 1 of 49" */
	   $paging =  "<table class='paging' width='100%'><tr><td align='left'>Displaying page " . $InfoArray["CURRENT_PAGE"] . " of " . $InfoArray["TOTAL_PAGES"] . "</td>";
	   
		$paging .=  "<td align='center'>";
	   /* Print our first link */
	   if($InfoArray["CURRENT_PAGE"]!= 1) {
		  $paging .=  "<a href=\"javascript:ajaxPaging('',1);\">&lt;&lt;</a> ";
	   } else {
		  $paging .=  "&lt;&lt; ";
	   }
	
	   /* Print out our prev link */
	   if($InfoArray["PREV_PAGE"]) {
		  $paging .=  "<a href=javascript:ajaxPaging(''," . $InfoArray["PREV_PAGE"] . ")>Previous</a> | ";
	   } else {
		  $paging .=  "Previous | ";
	   }
	
	   /* Example of how to print our number links! */
	   for($i=0; $i<count($InfoArray["PAGE_NUMBERS"]); $i++) {
		  if($InfoArray["CURRENT_PAGE"] == $InfoArray["PAGE_NUMBERS"][$i]) {
			 $paging .=  $InfoArray["PAGE_NUMBERS"][$i] . " | ";
		  } else {
			 $paging .=  "<a href=javascript:ajaxPaging(''," . $InfoArray["PAGE_NUMBERS"][$i] . ")>" . $InfoArray["PAGE_NUMBERS"][$i] . "</a> | ";
		  }
	   }
	
	   /* Print out our next link */
	   if($InfoArray["NEXT_PAGE"]) {
		  $paging .=   " <a href=javascript:ajaxPaging(''," . $InfoArray["NEXT_PAGE"] . ")>Next</a>";
	   } else {
		  $paging .=   " Next";
	   }
	
	   /* Print our last link */
	   if($InfoArray["CURRENT_PAGE"]!= $InfoArray["TOTAL_PAGES"]) {
		  $paging .=   " <a href=javascript:ajaxPaging(''," . $InfoArray["TOTAL_PAGES"] . ")>>></a>";
	   } else {
		  $paging .=   " &gt;&gt;";
	   }
	   
	    $InfoArray["START_OFFSET"] = ($InfoArray["START_OFFSET"] == 0) ? 1 : $InfoArray["START_OFFSET"];
		
	   $paging .=   "</td><td align='right'>Displaying results " . $InfoArray["START_OFFSET"] . " - " . $InfoArray["END_OFFSET"] . " of " . $InfoArray["TOTAL_RESULTS"] . "</td></tr></table>";
	   
	   return $paging;
	}
	
   function displayPagingReportGrid()
   {
	    /* Get our array of valuable paging information! */
	   $InfoArray = $this->InfoArray();
	   
	  // echo "<pre>"; print_r($InfoArray);
   	
		if($InfoArray["TOTAL_RESULTS"] <= RECORD_PER_PAGE)
			return null;
	   /* Everything below here are just examples! */
	
	   /* Print our some info like "Displaying page 1 of 49" */
	   $paging =  "<table class='paging' width='100%'><tr><td align='left'>Displaying page " . $InfoArray["CURRENT_PAGE"] . " of " . $InfoArray["TOTAL_PAGES"] . "</td>";
	   
		$paging .=  "<td align='center'>";
	   /* Print our first link */
	   if($InfoArray["CURRENT_PAGE"]!= 1) {
		  $paging .=  "<a href=\"javascript:ajaxReportPaging('',1);\">&lt;&lt;</a> ";
	   } else {
		  $paging .=  "&lt;&lt; ";
	   }
	
	   /* Print out our prev link */
	   if($InfoArray["PREV_PAGE"]) {
		  $paging .=  "<a href=javascript:ajaxReportPaging(''," . $InfoArray["PREV_PAGE"] . ")>Previous</a> | ";
	   } else {
		  $paging .=  "Previous | ";
	   }
	
	   /* Example of how to print our number links! */
	   for($i=0; $i<count($InfoArray["PAGE_NUMBERS"]); $i++) {
		  if($InfoArray["CURRENT_PAGE"] == $InfoArray["PAGE_NUMBERS"][$i]) {
			 $paging .=  "<strong>".$InfoArray["PAGE_NUMBERS"][$i] . "</strong> | ";
		  } else {
			 $paging .=  "<a href=javascript:ajaxReportPaging(''," . $InfoArray["PAGE_NUMBERS"][$i] . ")>" . $InfoArray["PAGE_NUMBERS"][$i] . "</a> | ";
		  }
	   }
	
	   /* Print out our next link */
	   if($InfoArray["NEXT_PAGE"]) {
		  $paging .=   " <a href=javascript:ajaxReportPaging(''," . $InfoArray["NEXT_PAGE"] . ")>Next</a>";
	   } else {
		  $paging .=   " Next";
	   }
	
	   /* Print our last link */
	   if($InfoArray["CURRENT_PAGE"]!= $InfoArray["TOTAL_PAGES"]) {
		  $paging .=   " <a href=javascript:ajaxReportPaging(''," . $InfoArray["TOTAL_PAGES"] . ")>>></a>";
	   } else {
		  $paging .=   " &gt;&gt;";
	   }
	   
	    $InfoArray["START_OFFSET"] = ($InfoArray["START_OFFSET"] == 0) ? 1 : $InfoArray["START_OFFSET"];
		
	   $paging .=   "</td><td align='right'>Displaying results " . $InfoArray["START_OFFSET"] . " - " . $InfoArray["END_OFFSET"] . " of " . $InfoArray["TOTAL_RESULTS"] . "</td></tr></table>";
	   
	   return $paging;
	}
	
   function displayTransactionPagingReportGrid()
   {
	    /* Get our array of valuable paging information! */
	   $InfoArray = $this->InfoArray();
   	
		if($InfoArray["TOTAL_RESULTS"] <= RECORD_PER_PAGE)
			return null;
	   /* Everything below here are just examples! */
	
	   /* Print our some info like "Displaying page 1 of 49" */
	   $paging =  "<table class='paging' width='100%'><tr><td align='left'>Displaying page " . $InfoArray["CURRENT_PAGE"] . " of " . $InfoArray["TOTAL_PAGES"] . "</td>";
	   
		$paging .=  "<td align='center'>";
	   /* Print our first link */
	   if($InfoArray["CURRENT_PAGE"]!= 1) {
		  $paging .=  "<a href=\"javascript:ajaxTransactionReportPaging('',1);\">&lt;&lt;</a> ";
	   } else {
		  $paging .=  "&lt;&lt; ";
	   }
	
	   /* Print out our prev link */
	   if($InfoArray["PREV_PAGE"]) {
		  $paging .=  "<a href=javascript:ajaxTransactionReportPaging(''," . $InfoArray["PREV_PAGE"] . ")>Previous</a> | ";
	   } else {
		  $paging .=  "Previous | ";
	   }
	
	   /* Example of how to print our number links! */
	   for($i=0; $i<count($InfoArray["PAGE_NUMBERS"]); $i++) {
		  if($InfoArray["CURRENT_PAGE"] == $InfoArray["PAGE_NUMBERS"][$i]) {
			 $paging .=  "<strong>".$InfoArray["PAGE_NUMBERS"][$i] . "</strong> | ";
		  } else {
			 $paging .=  "<a href=javascript:ajaxTransactionReportPaging(''," . $InfoArray["PAGE_NUMBERS"][$i] . ")>" . $InfoArray["PAGE_NUMBERS"][$i] . "</a> | ";
		  }
	   }
	
	   /* Print out our next link */
	   if($InfoArray["NEXT_PAGE"]) {
		  $paging .=   " <a href=javascript:ajaxTransactionReportPaging(''," . $InfoArray["NEXT_PAGE"] . ")>Next</a>";
	   } else {
		  $paging .=   " Next";
	   }
	
	   /* Print our last link */
	   if($InfoArray["CURRENT_PAGE"]!= $InfoArray["TOTAL_PAGES"]) {
		  $paging .=   " <a href=javascript:ajaxTransactionReportPaging(''," . $InfoArray["TOTAL_PAGES"] . ")>>></a>";
	   } else {
		  $paging .=   " &gt;&gt;";
	   }
	   
	    $InfoArray["START_OFFSET"] = ($InfoArray["START_OFFSET"] == 0) ? 1 : $InfoArray["START_OFFSET"];
		
	   $paging .=   "</td><td align='right'>Displaying results " . $InfoArray["START_OFFSET"] . " - " . $InfoArray["END_OFFSET"] . " of " . $InfoArray["TOTAL_RESULTS"] . "</td></tr></table>";
	   
	   return $paging;
	}
	
   function displayCommonPaging($onClick='')
   {
	    /* Get our array of valuable paging information! */
	   $InfoArray = $this->InfoArray();
   	
		if($InfoArray["TOTAL_RESULTS"] <= RECORD_PER_PAGE)
			return null;
	   /* Everything below here are just examples! */
	
	   /* Print our some info like "Displaying page 1 of 49" */
	   $paging =  "<table class='paging' width='100%'><tr><td align='left'>Displaying page " . $InfoArray["CURRENT_PAGE"] . " of " . $InfoArray["TOTAL_PAGES"] . "</td>";
	   
		$paging .=  "<td align='center'>";
	   /* Print our first link */
	   if($InfoArray["CURRENT_PAGE"]!= 1) {
		  $paging .=  "<a href=\"javascript:".$onClick."('',1);\">&lt;&lt;</a> ";
	   } else {
		  $paging .=  "&lt;&lt; ";
	   }
	
	   /* Print out our prev link */
	   if($InfoArray["PREV_PAGE"]) {
		  $paging .=  "<a href=javascript:".$onClick."(''," . $InfoArray["PREV_PAGE"] . ")>Previous</a> | ";
	   } else {
		  $paging .=  "Previous | ";
	   }
	
	   /* Example of how to print our number links! */
	   for($i=0; $i<count($InfoArray["PAGE_NUMBERS"]); $i++) {
		  if($InfoArray["CURRENT_PAGE"] == $InfoArray["PAGE_NUMBERS"][$i]) {
			 $paging .=  "<strong>".$InfoArray["PAGE_NUMBERS"][$i] . "</strong> | ";
		  } else {
			 $paging .=  "<a href=javascript:".$onClick."(''," . $InfoArray["PAGE_NUMBERS"][$i] . ")>" . $InfoArray["PAGE_NUMBERS"][$i] . "</a> | ";
		  }
	   }
	
	   /* Print out our next link */
	   if($InfoArray["NEXT_PAGE"]) {
		  $paging .=   " <a href=javascript:".$onClick."(''," . $InfoArray["NEXT_PAGE"] . ")>Next</a>";
	   } else {
		  $paging .=   " Next";
	   }
	
	   /* Print our last link */
	   if($InfoArray["CURRENT_PAGE"]!= $InfoArray["TOTAL_PAGES"]) {
		  $paging .=   " <a href=javascript:".$onClick."(''," . $InfoArray["TOTAL_PAGES"] . ")>>></a>";
	   } else {
		  $paging .=   " &gt;&gt;";
	   }
	   
	   $InfoArray["START_OFFSET"] = ($InfoArray["START_OFFSET"] == 0) ? 1 : $InfoArray["START_OFFSET"];
	   
	   $paging .=   "</td><td align='right'>Displaying results " . $InfoArray["START_OFFSET"] . " - " . $InfoArray["END_OFFSET"] . " of " . $InfoArray["TOTAL_RESULTS"] . "</td></tr></table>";
	   
	   return $paging;
	}
	
}

?>