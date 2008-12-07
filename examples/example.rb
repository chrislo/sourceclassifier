require 'rubygems'
require 'sourceclassifier'

s = SourceClassifier.new

ruby_text = <<EOT
def my_sorting_function(a)
  a.sort
end
EOT

c_text = <<EOT
#include <unistd.h>

int main() {
  write(1, "hello world\n", 12);
  return(0);
}
EOT

s.identify(ruby_text) #=> Ruby
s.identify(c_text) #=> Gcc
