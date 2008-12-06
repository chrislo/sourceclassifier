#########################################
#     The Computer Language Shootout    #
#   http://shootout.alioth.debian.org/  #
#                                       #
#      Contributed by Jesse Millikan    #
#########################################

use threads;
use threads::shared;

# Complement method is numerical based on Haskell version
my ($red, $yellow, $blue, $none) = (0,1,2,3);

# Count, signal and mutex are all $meetings
my $meetings : shared = $ARGV[0];

# Locked and updated by each thread when it ends
my $total_meetings : shared = 0;

# Colour communication variables
my $first : shared = $none;
my $second : shared = $none;

# $_ is thread on the outer map and color on the inner loop
map { $_->join } (map {
 # async starts a new thread running the block given
 async {
  my ($color, $other_color) = ($_,$none);
  my $met = 0; 

  # with 'redo', loop until 'last' is called
  LIVE: { 

   # Meeting place 
   { 
    lock $meetings;
    
    last LIVE if($meetings <= 0); # 'fade' by jumping out of the block

    if($first != $none){
     $other_color = $first;
     $second = $color;
     cond_signal $meetings; 
     $meetings -= 1;
     $first = $none;
    }
    else
    {
     $first = $color; 
     cond_wait $meetings;
     $other_color = $second;
    }
   } # Unlock the meeting place 

   $color = 3 - $color - $other_color if($color != $other_color);
   $met++;

   redo;
  }

  # Lock the total and add own to it before dying
  lock $total_meetings;
  $total_meetings += $met;
 }
} ($blue, $red, $yellow, $blue));

print "$total_meetings\n";
