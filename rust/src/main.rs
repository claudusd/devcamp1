use std::env;
extern crate csv;

fn main() {
    let args: Vec<String> = env::args().collect();
    println!("{:?}", args);
}
