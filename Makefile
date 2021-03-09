zip:
	zip -j xpleva07.zip src/* README.md
	printf "@ README.md\n@=readme1.md\n" | zipnote -w xpleva07.zip

test: zip
	./spec/is_it_ok.sh xpleva07.zip tmp

clean:
	rm xpleva07.zip
	rm -rf tmp