require 'rubygems'

require 'rake'
require 'rake/testtask'
require 'find'
require 'FileUtils'
require 'echoe'

Echoe.new('sourceclassifier', '0.1.0') do |p|
  p.description    = "Determine the programming language used in a sample"
  p.url            = "http://github.com/chrislo/sourceclassifier/tree/master"
  p.author         = "Chris Lowis"
  p.email          = "chris.lowis@gmail.com"
  p.ignore_pattern = ["tmp/*", "script/*", "sources/*"]
  p.runtime_dependencies = ["classifier"]
  p.development_dependencies = []
end

Dir["#{File.dirname(__FILE__)}/tasks/*.rake"].sort.each { |ext| load ext }

module Find
  def match(*paths)
    matched = []
    find(*paths) { |path| matched << path if yield path }
    return matched
  end
  module_function :match
end	

SHOOTOUT_CVS_ROOT = '/Users/chris/tmp/shootout-scm-2008-08-24/'

task :default => [:test_units]

desc "Run basic tests"
Rake::TestTask.new("test_units") { |t|
  t.pattern = 'test/test_*.rb'
  t.verbose = false
  t.warning = false
}

desc "Populate training data directories"
task :populate do
  languages = %w[ruby python gcc perl]

  languages.each do |language|
    # create directories
    target_dir = "./sources/#{language}"
    FileUtils.mkdir_p target_dir

    # copy source files to appropriate directories
    Find.match(SHOOTOUT_CVS_ROOT) do |file| 
      this_ext = File.extname(file).downcase
      if this_ext == ".#{language}"
        FileUtils.cp file, "#{target_dir}/#{File.basename(file)}"
      end
    end
  end
end

desc "Train using training data directory"
task :train do
  require './lib/trainer.rb'
  t = Trainer.new('./sources','./')
end
