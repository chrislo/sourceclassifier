#!/usr/bin/perl
# $Id: sumcol.perl,v 1.1.1.1 2004-05-19 18:13:44 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/

use integer;
shift;
while (<>) { $tot += $_ }
print "$tot\n";
