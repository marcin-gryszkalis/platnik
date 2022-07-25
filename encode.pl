#!/usr/bin/perl -w
# mg@fork.pl
# https://platnik.fork.pl/
# https://github.com/marcin-gryszkalis/platnik/
use strict;
use warnings;

my $enc = shift;

sub swap($$)
{
    $_ = shift;
    my $n = shift;
    s/(.{$n})(.{$n})/$2$1/g;
    return $_;
}

my $k = "lmnopqrstuvwxyz{";

my @pkey = (
swap($k, 8),
swap(swap($k, 4), 1),
swap(swap($k, 8), 1),
swap($k, 1),
swap($k, 4),
swap($k, 2),
swap(swap($k, 2), 1),
swap(swap(swap($k, 4), 2), 1),
);

my @order = (
0,1,2,3,4,0,3,5,
2,1,5,4,3,6,6,2,
4,2,2,4,3,2,7,7);

my $i = 0;
sub enc($)
{
    my $c = ord shift;
    my $a = $c & 0xf;
    my $b = $c >> 4;
    $a = substr($pkey[$order[$i % 24]], $a, 1);
    $b = substr($pkey[$order[$i % 24]], $b, 1);
    $i++;
    return "$a$b";
}

$enc =~ s/(.)/enc($1)/ge;
print "$enc\n";
