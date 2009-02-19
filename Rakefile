require 'rubygems'

require 'rake'
require 'rake/testtask'
require 'find'
require 'fileutils'
require 'echoe'

Echoe.new('sourceclassifier', '0.2.3') do |p|
  p.description    = "Determine the programming language used in a code snippet"
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

namespace :populate do
  desc "Run all population rake tasks"
  task :all => ['shootout','css']

  desc "Populate training data directories from shootout sources"
  task :shootout do
    languages = %w[gcc java javascript perl php python ruby]

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

  desc "Populate using css from csszengarden"
  task :css do

    target_dir = "./sources/css"
    FileUtils.mkdir_p target_dir

    (100..200).each do |i|
      url = "http://csszengarden.com/#{i}/#{i}.css"
      puts "Fetching #{url}"
      system("curl -o ./sources/css/csszengarden_#{i}.css #{url}")
      sleep(2) # be kind
    end
  end
end

desc "Train using training data directory"
task :train do
  require './lib/trainer.rb'
  t = Trainer.new('./sources','./')
end
