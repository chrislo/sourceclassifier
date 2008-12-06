require File.join(File.dirname(__FILE__), '..', 'lib', 'trainer')
require File.join(File.dirname(__FILE__), '..', 'lib', 'sourceclassifier')

require 'test/unit'

class TestSourceClassifier < Test::Unit::TestCase

  def setup
    sources_dir = File.join(File.dirname(__FILE__), 'fixtures', 'sources')
    @output_dir = File.join(File.dirname(__FILE__), 'fixtures', 'output')
    Trainer.new(sources_dir,@output_dir)
    @c = SourceClassifier.new(@output_dir + "/trainer.bin")
  end

  def teardown
    FileUtils.rm_r @output_dir
  end

  def test_default_training_file
    require 'ftools'
    assert_equal(@c.training_file, @output_dir + "/trainer.bin")
    
    d = SourceClassifier.new()
    assert(File.compare(d.training_file, File.join(File.dirname(__FILE__), '..', 'trainer.bin')))
  end

  def test_languages
    ["Ruby","Python","Gcc"].each do |language|
      assert(@c.languages.include?(language))
    end
  end

  def test_identify
    # Test the classifier with one of the files used to train it. This
    # should always return the correct source code type
    str = open(File.join(File.dirname(__FILE__), 'fixtures', 'sources','ruby','ackermann.ruby')) {|f| f.read}
    assert_equal("Ruby",@c.identify(str))
  end

end
