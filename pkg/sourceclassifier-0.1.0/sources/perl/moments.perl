#!/usr/bin/perl
# $Id: moments.perl,v 1.1.1.1 2004-05-19 18:10:48 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/

use strict;

my @nums = <STDIN>;
my $sum = 0;
foreach (@nums) { $sum += $_ }
my $n = scalar(@nums);
my $mean = $sum/$n;
my $average_deviation = 0;
my $standard_deviation = 0;
my $variance = 0;
my $skew = 0;
my $kurtosis = 0;
foreach (@nums) {
    my $deviation = $_ - $mean;
    $average_deviation += abs($deviation);
    $variance += $deviation**2;
    $skew += $deviation**3;
    $kurtosis += $deviation**4;
}
$average_deviation /= $n;
$variance /= ($n - 1);
$standard_deviation = sqrt($variance);

if ($variance) {
    $skew /= ($n * $variance * $standard_deviation);
    $kurtosis = $kurtosis/($n * $variance * $variance) - 3.0;
}

@nums = sort { $a <=> $b } @nums;
my $mid = int($n/2);
my $median = ($n % 2) ? $nums[$mid] : ($nums[$mid] + $nums[$mid-1])/2;

printf("n:                  %d\n", $n);
printf("median:             %f\n", $median);
printf("mean:               %f\n", $mean);
printf("average_deviation:  %f\n", $average_deviation);
printf("standard_deviation: %f\n", $standard_deviation);
printf("variance:           %f\n", $variance);
printf("skew:               %f\n", $skew);
printf("kurtosis:           %f\n", $kurtosis);
