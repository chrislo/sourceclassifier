require 'rubygems'
require 'classifier'
require 'ruby-debug'


class Trainer
  attr_reader :classifier

  def initialize(sources_dir, output_dir)
    @classifier = train(sources_dir,output_dir)
  end

  def train(sources_dir,output_dir)
    b = Classifier::Bayes.new 

    languages = Trainer.languages_for(sources_dir)
    
    languages.each do |language|
      b.add_category language

      files = Trainer.files_for(sources_dir,language)
      files.each do |f|
        file_content = File.read(f)
        b.train language, file_content
      end
    end

    marshal(output_dir,b)
    return b
  end
  
  def self.languages_for(sources_dir)
    languages = Dir["#{sources_dir}/*"].map {|dir| dir.split("/").last}
  end

  def self.files_for(sources_dir,language)
    files = Dir["#{sources_dir}/#{language}/*"]
  end

  private

  def marshal(output_dir, data)
    FileUtils.mkdir_p(output_dir)
    Dir.chdir(output_dir) do
      open("trainer.bin", "w") { |f| Marshal.dump(data, f) }
    end
  end



end
