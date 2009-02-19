# -*- encoding: utf-8 -*-

Gem::Specification.new do |s|
  s.name = %q{sourceclassifier}
  s.version = "0.2.3"

  s.required_rubygems_version = Gem::Requirement.new(">= 1.2") if s.respond_to? :required_rubygems_version=
  s.authors = ["Chris Lowis"]
  s.date = %q{2009-02-19}
  s.description = %q{Determine the programming language used in a code snippet}
  s.email = %q{chris.lowis@gmail.com}
  s.extra_rdoc_files = ["lib/sourceclassifier.rb", "lib/trainer.rb", "README.textile"]
  s.files = ["examples/example.rb", "lib/sourceclassifier.rb", "lib/trainer.rb", "Rakefile", "HISTORY", "README.textile", "sourceclassifier.gemspec", "test/fixtures/sources/gcc/ackermann.gcc-2.gcc", "test/fixtures/sources/python/ackermann.python", "test/fixtures/sources/ruby/ackermann.ruby", "test/test_source_classifier.rb", "test/test_trainer.rb", "trainer.bin", "Manifest"]
  s.has_rdoc = true
  s.homepage = %q{http://github.com/chrislo/sourceclassifier/tree/master}
  s.rdoc_options = ["--line-numbers", "--inline-source", "--title", "Sourceclassifier", "--main", "README.textile"]
  s.require_paths = ["lib"]
  s.rubyforge_project = %q{sourceclassifier}
  s.rubygems_version = %q{1.3.1}
  s.summary = %q{Determine the programming language used in a code snippet}
  s.test_files = ["test/test_source_classifier.rb", "test/test_trainer.rb"]

  if s.respond_to? :specification_version then
    current_version = Gem::Specification::CURRENT_SPECIFICATION_VERSION
    s.specification_version = 2

    if Gem::Version.new(Gem::RubyGemsVersion) >= Gem::Version.new('1.2.0') then
      s.add_runtime_dependency(%q<classifier>, [">= 0"])
    else
      s.add_dependency(%q<classifier>, [">= 0"])
    end
  else
    s.add_dependency(%q<classifier>, [">= 0"])
  end
end
