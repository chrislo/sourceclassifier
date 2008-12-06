require File.join(File.dirname(__FILE__), '..', 'lib', 'trainer')
require 'test/unit'

class TestTrainer < Test::Unit::TestCase
  def setup
    @sources_dir = File.join(File.dirname(__FILE__), 'fixtures', 'sources')
    @output_dir = File.join(File.dirname(__FILE__), 'fixtures', 'output')
    @t = Trainer.new(@sources_dir,@output_dir)
  end

  def teardown
    FileUtils.rm_r @output_dir
  end
  
  def test_available_languages
    assert_equal(3,Trainer.languages_for(@sources_dir).size)
  end
  
  def test_get_files_for_language
    files = Trainer.files_for(@sources_dir,'ruby')
    assert_equal(1,files.size)
    assert_equal("#{@sources_dir}/ruby/ackermann.ruby",files[0])
  end

  def test_train
    assert(@t.classifier.categories.include?("Ruby"))
    assert(@t.classifier.categories.include?("Gcc"))
  end

  def test_creates_output_file
    assert(File.exists?(@output_dir + "/trainer.bin"))
  end

end
