require 'rubygems'
require 'classifier'

class SourceClassifier

  attr_reader :training_file

  def initialize(training_file=nil)
    training_file = File.join(File.dirname(__FILE__), '..', 'trainer.bin') unless training_file
    @training_file = training_file
    open(@training_file, "r") { |f| @c = Marshal.load(f)}
  end

  def languages
    @c.categories
  end

  def identify(str)
    @c.classify(str)
  end

end
