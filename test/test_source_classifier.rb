require File.join(File.dirname(__FILE__), '..', 'lib', 'trainer')
require File.join(File.dirname(__FILE__), '..', 'lib', 'source_classifier')

require 'test/unit'

class TestSourceClassifier < Test::Unit::TestCase

  def setup
    sources_dir = File.join(File.dirname(__FILE__), 'fixtures', 'sources')
    @output_dir = File.join(File.dirname(__FILE__), 'fixtures', 'output')
    Trainer.new(sources_dir,@output_dir)
    @classifier = SourceClassifier.new(@output_dir + "/trainer.bin")
  end

  def teardown
    FileUtils.rm_r @output_dir
  end

  def test_languages
    ["Ruby","Python","Gcc"].each do |language|
      assert(@classifier.languages.include?(language))
    end
  end

end
