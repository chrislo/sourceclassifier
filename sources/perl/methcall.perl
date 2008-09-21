#!/usr/bin/perl
# $Id: methcall.perl,v 1.1.1.1 2004-05-19 18:10:41 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/
# with help from Ben Tilly

package Toggle;

sub new {
    my($class, $start_state) = @_;
    bless( { Bool => $start_state }, $class );
}

sub value {
    (shift)->{Bool};
}

sub activate {
    my $self = shift;
    $self->{Bool} ^= 1;
    return($self);
}


package NthToggle;
our @ISA = qw(Toggle);

sub new {
    my($class, $start_state, $max_counter) = @_;
    my $self = $class->SUPER::new($start_state);
    $self->{CountMax} = $max_counter;
    $self->{Counter} = 0;
    return($self);
}

sub activate {
    my $self = shift;
    if (++$self->{Counter} >= $self->{CountMax}) {
	$self->{Bool} ^= 1;
	$self->{Counter} = 0;
    }
    return($self);
}


package main;

sub main {
    my $NUM = $ARGV[0];
    $NUM = 1 if ($NUM < 1);

    my $val = 1;
    my $toggle = Toggle->new($val);
    for (1..$NUM) {
	$val = $toggle->activate->value;
    }
    print (($val) ? "true\n" : "false\n");

    $val = 1;
    my $ntoggle = NthToggle->new($val, 3);
    for (1..$NUM) {
	$val = $ntoggle->activate->value;
    }
    print (($val) ? "true\n" : "false\n");
}

main();
